<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Setting;
use App\Models\Payments;
use App\Models\Department;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payments::with('faculty', 'department')->latest()->get();
        return view('backend.payments.index', compact('payments'));
    }


    public function create()
    {
        // $faculties = Faculty::whereHas('courses')->latest()->get();
        $faculties = Faculty::latest()->get();
        // $departments = Department::whereHas('courses')->latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();

        return view('backend.payments.create', compact('faculties', 'departments', 'years'));
    }

    public function store(Request $request)
    {
        $newPayment = Payments::create([
            'name' => $request->name,
            'program' => $request->program,
            'level' => $request->level,
            'session' => $request->session,
            'department_id' => $request->department,
            'faculty_id' => $request->faculty_id,
            'semester' => $request->semester,
            'status' => $request->status,
        ]);

        return redirect(route('payments.index'))->with('message', 'Operation successfull');
    }

    public function showPayments(){
        $student = auth()->user()->student;
        
        $payments = Payments::where(function($query) use ($student) {
            $query->where('department_id', $student->department_id)->orwhere('department_id',0)->get();
        })
        ->where(function($query) use ($student) {
            $query->where('faculty_id', $student->faculty_id)->orwhere('faculty_id',0)->get();
        })
        ->where(function ($query) use ($student) {
            $query->where('program', $student->program)->orwhere('program', 0)->get();
        })
        ->where(function ($query) use ($student) {
            $query->where('semester', (int) $student->semester)->orwhere('semester', 0)->get();
        })
        ->where(function ($query) use ($student) {
            $query->where('level', $student->level)->orwhere('level', 0)->get();
        })
        ->where('status', 'active');

        $payments = $payments->get();
       
        $title = 'Make payments';
        return view('dashboard.student.payments', compact('payments', 'title','student'));
    }

    public function initializePayment($id){
        $student = auth()->user()->student;
        $check_payment = Transaction::where('student_id', $student->id)->where('payment_id', $id)->where('status', 'success')->get();
        if($check_payment && $check_payment->count() > 0){
            return back()->with('warning', 'You have already made this payment');
        }
        $payment = Payments::find($id);
        $setting = Setting::first();
        // initilize transaction

        // Check if student had made this payment before
        $transaction = $this->createTransaction($student, $payment);
        
        $url = "https://api.paystack.co/transaction/initialize";

        $fields = [
            'email' => auth()->user()->email,
            'amount' => $payment->amount * 100,
            'reference' => $transaction->reference,
            'callback_url' => url('/').'/payment/callback',         
        ];
        
        //execute curl
        $response = $this->paystackLink($url, $fields);
        if(isset($response->data->authorization_url)){
            return redirect()->away($response->data->authorization_url);
        }else{
            return back()->with('error', 'Something went wrong, please try again!');
        }
        
    }

    public function processPayment(Request $request){
        // Query Payment status        
        $status = json_decode($this->queryTransaction($request->reference));
        if(isset($status->data) && $status->data->status === 'success'){
            $transaction = app('App\Http\Controllers\TransactionController')->updateTransaction($request['reference'], $status->data->status);
        }
        
        return redirect(route('make-payments'))->with('message', 'Payment successful');
    }

    public function paymentsHistory(){
        $student = auth()->user()->student;
        $transactions = $student->transactions;
       
        return view('dashboard.student.payment_history', compact('student', 'transactions'));
    }

    public function paystackLink($url, $fields)
    {
        $fields_string = http_build_query($fields);
        $setting = Setting::first();
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $setting->PAYSTACK_SECRET_KEY",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        return json_decode(curl_exec($ch));
    }

    public function queryTransaction($reference){
        $setting = Setting::first();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $setting->PAYSTACK_SECRET_KEY",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        
        return $response;
    }
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(Payments $payment)
    {
        $faculties = Faculty::latest()->get();
        $departments = Department::latest()->get();
        $years = $this->getSessions();

        return view('backend.payments.edit', compact('faculties', 'departments', 'years', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payments $payment)
    {
        // dd($request->all());
        $payment->update([
            'name' => $request->name,
            'program' => $request->program,
            'level' => $request->level,
            'department_id' => $request->department,
            'faculty_id' => $request->faculty,
            'semester' => $request->semester,
            'status' => $request->status,
            'amount' => $request->amount,
        ]);
        // dd($payment);
        return redirect(route('payments.index'))->with('message', 'Operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payments $payment)
    {
        $payment->delete();

        return back()->with('message', 'Operation successful');
    }
}

<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Payments;
use App\Department;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payments::with('faculty', 'department')->latest()->get();
        return view('backend.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::whereHas('courses')->latest()->get();
        $departments = Department::whereHas('courses')->latest()->get();
        $years = $this->getSessions();

        return view('backend.payments.create', compact('faculties', 'departments', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Payments  $payments
     * @return \Illuminate\Http\Response
     */
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

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('user', 'faculty','department')->latest()->get();
        return view('backend.transaction.index', compact('transactions'));
    }

    public function getTransaction($reference){
        $year = explode("-", $reference);
        $year = $year[0];
        if($year[0] === date('Y')){
            $transaction = Transaction::whereReference($reference)->first();
        }else{
            $transaction = \DB::table('transactions_2021')->where('reference', $reference)->first();
        }
        return $transaction;
    }

    public function updateTransaction($reference, $status)
    {
        $years = explode("-", $reference);
        $year = $years[0];
        try {
            if ($year === date('Y')) {
                $transaction = Transaction::whereReference($reference)->first()->update(['status' => $status]);
            } else {
                $transaction = \DB::table('transactions_2021')->where('reference', $reference)->update(['status' => $status]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        return;
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

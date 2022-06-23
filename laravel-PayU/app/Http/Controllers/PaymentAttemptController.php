<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentAttemptRequest;
use App\Http\Requests\UpdatePaymentAttemptRequest;
use App\Models\PaymentAttempt;

class PaymentAttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentAttemptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentAttemptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentAttempt  $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentAttempt $paymentAttempt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentAttempt  $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentAttempt $paymentAttempt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentAttemptRequest  $request
     * @param  \App\Models\PaymentAttempt  $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentAttemptRequest $request, PaymentAttempt $paymentAttempt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentAttempt  $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentAttempt $paymentAttempt)
    {
        //
    }
}

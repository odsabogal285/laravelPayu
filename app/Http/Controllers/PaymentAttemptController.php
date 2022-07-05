<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentAttemptRequest;
use App\Http\Requests\UpdatePaymentAttemptRequest;
use App\Models\PaymentAttempt;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * @param \App\Http\Requests\StorePaymentAttemptRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Lo que llega ' . $request);
        if (isset($request)) {
            $reference_sale = $request->reference_sale;
            $reference_pol = $request->reference_pol;
            $transaction_id = $request->transaction_id;

            $references = PaymentAttempt::where('reference_pol', $reference_pol)->get();
            Log::info('reference ' . $references);
            //return response()->json(null, 200);


            // if(!$references){
            //     if($request->state_pol==4){
            //         $this->insertBill(1, 123, 'Aproveed', 1, $transaction_id);
            //         //$this->insertPayment(1, 123, 'Aproveed', 1, $reference_sale, $reference_pol);
            //     }else if($request->state_pol==6){
            //         $createtBill = $this->insertBill(1, 123, 'Declined', 0, $transaction_id);

            //         $this->insertPayment($createtBill->id, 123, 'Aproveed', 1, $reference_sale, $reference_pol);
            //     }
            // }else{
            //    // Update
            //     // if($request->state_pol==4){
            //     //     $this->insertBill(1, 123, 'Aproveed', 1, $transaction_id);
            //     //     //$this->insertPayment(1, 123, 'Aproveed', 1, $reference_sale, $reference_pol);
            //     // }else if($request->state_pol==6){
            //     //     $createtBill = $this->insertBill(1, 123, 'Declined', 0, $transaction_id);

            //     //     $this->insertPayment($createtBill->id, 123, 'Aproveed', 1, $reference_sale, $reference_pol);
            //     // }
            // }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PaymentAttempt $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentAttempt $paymentAttempt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PaymentAttempt $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentAttempt $paymentAttempt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePaymentAttemptRequest $request
     * @param \App\Models\PaymentAttempt $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentAttemptRequest $request, PaymentAttempt $paymentAttempt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PaymentAttempt $paymentAttempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentAttempt $paymentAttempt)
    {
        //
    }


    public function confirmacion(Request $request)
    {
        Log::info('Lo que llega ' . $request);
        if (isset($request)) {
            $reference_sale = $request->reference_sale;
            $reference_pol = $request->reference_pol;
            $transaction_id = $request->transaction_id;

            $references = PaymentAttempt::where('reference_pol', $reference_pol)->get();
            Log::info('reference ' . $references);
            if (sizeof($references) === 0) {


                if ($request->state_pol == 4) { // Aproved
                    $createtBill = $this->insertBill(1, $request->value, 'Aproveed', 1, $transaction_id); // Change user_id
                    $this->insertPayment($createtBill->id, $request->value, 'Aproveed', $reference_sale, $reference_pol);
                } else if ($request->state_pol == 6) { // Declined
                    $createtBill = $this->insertBill(1, $request->value, 'Declined', 0, $transaction_id); // Change User_id
                    $this->insertPayment($createtBill->id, $request->value, 'Declined', $reference_sale, $reference_pol);
                }

            } else {
                // Update
                Log::info('Existe la referencia - update');
                if ($request->state_pol == 4) {
                    $this->updateBill($references, 1);
                } else if ($request->state_pol == 6) {
                    $this->updateBill($references, 0);
                }
            }
        }
        return response()->json(null, 200);
    }

    public function updateBill($references, $paid)
    {
        $bill = Bill::find($references->bill_id);
        $bill->transaction_id = $references->transaction_id;
        $bill->paid = $paid;
        $bill->save();
    }

    public function insertBill($user_id, $value, $details, $paid, $transaction_id): Bill
    {
        return $bill = Bill::create([
            'user_id' => 1,
            'value' => $value,
            'details' => $details,
            'paid' => $paid,
            'transaction_id' => $transaction_id,
        ]);

    }

    public function insertPayment($bill_id, $value, $details, $reference_sale, $reference_pol)
    {
        $bill = PaymentAttempt::create([
            'bill_id' => $bill_id,
            'value' => 123,
            'details' => $details,
            'reference_sale' => $reference_sale,
            'reference_pol' => $reference_pol,
        ]);

    }
}

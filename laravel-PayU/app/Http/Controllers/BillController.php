<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('/bill/index')->with('bill', $request);
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
     * @param  \App\Http\Requests\StoreBillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillRequest  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
    public function respuesta(){
        return view('/bill/respuesta');
    }
    public function confirmacion(Request $request){
        $merchantId = $_REQUEST['merchantId'];
        $orderId = $_REQUEST['orderId'];
        $referenceCode = $_REQUEST['referenceCode'];
        $description = $_REQUEST['description'];
        $response_code_pol = $_REQUEST['response_code_pol'];

        $bill = Bill::create([
            'user_id' => 1,
            'value' => $merchantId,
            'details' => 'PruebaLaravelPay'
        ]);
        /*
         * //2c8907d6c66527fdddde71b52c359c3f
        $sign = $_REQUEST['signature'];
        $firma = '2c8907d6c66527fdddde71b52c359c3f';
        if( strcmp($sign, $firma) == 0 ){
            $bill = Bill::create([
                'user_id' => 1,
                'value' => 12.2,
                'details' => 'PruebaLaravelPay'
            ]);
        }

        $state_pol= $request['response_code_pol'];
        if($state_pol == 4) {
            $bill = Bill::create([
                'user_id' => 1,
                'value' => 12.2,
                'details' => 'PruebaLaravelPay'
            ]);
        }
        */
    }
    public function confir(Request $request)
    {
        $bill = Bill::create([
            'user_id' => 1,
            'value' => 12.2,
            'details' => 'PruebaLaravelPay'
        ]);
    }
}

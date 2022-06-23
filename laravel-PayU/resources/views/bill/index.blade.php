@extends('theme.base')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="text-center">Recaudo virtual</h1>
        <p class="text-center">Verifíca tus datos</p>
        <div class="row justify-content-center">
            <label for="" class="col-4 text-end">Nombre:</label>
            <p class="col-4 text-start">{{$bill->name ?? null}}</p>
        </div>
        <div class="row justify-content-center">
            <label for="" class="col-4 text-end">Apellidos:</label>
            <p class="col-4 text-start">{{$bill->surname ?? null}}</p>
        </div>
        <div class="row justify-content-center">
            <label for="" class="col-4 text-end">Número de documento</label>
            <p class="col-4 text-start">{{$bill->document ?? null}}</p>
        </div>
        <div class="row justify-content-center">
            <label for="" class="col-4 text-end">Email</label>
            <p class="col-4 text-start">{{$bill->email ?? null}}</p>
        </div>
        <div class="row justify-content-center">
            <label for="" class="col-4 text-end">Teléfono móvil</label>
            <p class="col-4 text-start">{{$bill->phone ?? null}}</p>
        </div>
        <div class="row justify-content-center">
            <label for="" class="col-4 text-end">Valor</label>
            <p class="col-4 text-start">{{$bill->value ?? null}}</p>
        </div>
        <?php
        // "ApiKey~merchantId~referenceCode~amount~currency"
        $ApiKey = '4Vj8eK4rloUd272L48hsrarnUA';
        $merchanId = '508029';
        $amount = $bill -> value ?? 0;
        $referenceCode = $bill->bill ?? 'PayUL0012';
        $currency = 'COP';
        $encrypMD5 = md5($ApiKey . '~' . $merchanId . '~' . $referenceCode . '~' . $amount . '~' . $currency);
        echo $encrypMD5;
        ?>
        <form action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/" method="post">
            @csrf
            <input type="hidden" name="billing" value={{$bill ?? null}}>
            <input name="merchantId" type="hidden" value="508029">
            <input name="accountId" type="hidden" value="512321">
            <input name="description" type="hidden" value="Test PAYU">
            <input name="referenceCode" type="hidden" value="{{$referenceCode}}">
            <input name="amount" type="hidden" value="{{$bill->value ?? 0}}">
            <input name="tax" type="hidden" value="3193">
            <input name="taxReturnBase" type="hidden" value="16806">
            <input name="currency" type="hidden" value="COP">
            <input name="signature" type="hidden" value="{{$encrypMD5}}">
            <input name="test" type="hidden" value="1">
            <input name="buyerEmail" type="hidden" value="{{$bill->email}}">
            <input name="responseUrl" type="hidden" value="http:20.25.36.217:80/respuesta">
            <input name="confirmationUrl" type="hidden" value="http://20.25.36.217:80/confirmacion">
            <input name="Submit" type="submit" value="Enviar">
        </form>
    </div>
@endsection


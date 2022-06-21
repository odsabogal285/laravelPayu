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
        <div class="row justify-content-center" >
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
        <form action="" method="post">
            @csrf
            <input type="hidden" name="billing" value={{$bill ?? null}}>
            <p class="text-center">Si los datos son correctos da click en el botón de PAGAR</p>
            <button class="btn btn-info">PAGAR</button>
            <p class="text-center">Regresar y editar</p>
            <button class="btn btn-info">Regresar y editar</button>
        </form>
    </div>
@endsection

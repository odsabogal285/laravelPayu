@extends('theme.base')

@section('content')
    <div class="container py-5 text-center">
        <a href="{{route('login')}}">login</a>
        <a href="{{route('register')}}">register</a>
        <form action="{{route('billing')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="bill" class="form-label">Numero de tu Factura</label>
                <input type="number" name="bill" class="form-control" placeholder="# de factura" value="{{old('bill')}}">
                <label for="value" class="form-label">Valor total a pagar</label>
                <input type="number" name="value" class="form-control" placeholder="Valor total a pagar sin puntos" step="0.01" value="{{old('value')}}">
                <label for="name" class="form-label">Nombres</label>
                <input type="text" name="name" class="form-control" placeholder="Ingrese sus nombres" value=""{{old('name')}}>
                <label for="surname" class="form-label">Apellidos</label>
                <input type="text" name="surname" class="form-control" placeholder="Ingrese sus apellidos" value="{{old('surname')}}">
                <label for="document" class="form-label">Documento de identidad</label>
                <input type="text" name="document" class="form-control" placeholder="Ingrese su documento" value="{{old('document')}}">
                <label for="email" class="form-label">Correo electronico</label>
                <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electronico (Asegurese que esté bien escrito)" value="{{old('email')}}">
                <label for="phone" class="form-label">Teléfono móvil</label>
                <input type="text" name="phone" class="form-control" placeholder="Ingrese su teléfono móvil" value="{{old('phone')}}">
                <p class="text-center" name="subtotal"></p>
                <p class="text-center" name="commission"></p>
                <p class="text-center" name="total"></p>
                <p class="text-center">Acepto términos y condiciones</p>
                <button class="btn btn-info">Continuar</button>
            </div>

        </form>
    </div>
@endsection

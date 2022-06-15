@extends('theme.base')

@section('content')
    <div class="container py-5 text-center"> 
        <h1> Listado de clientes </h1>
        <a href="{{ route('client.create') }}" class="btn btn-primary">Crear clientes</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">FelinoHost</td>
                    <td> 0.0 </td>
                    <td>Editar - Eliminar</td>
                </tr>
                <tr>
                    <td scope="row"> </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
    </div>
@endsection
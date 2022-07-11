@extends('theme.base')

@section('content')
<div class="container py5 text-center">
    <h1> Listado de usuarios </h1>
    <a href="" class="btn btn-primary">Crear usuario</a>
    @if(Session::has('mensaje'))
        <div class="alert alert-info my-5">
            {{Session::get('mensaje')}}
        </div>
    @endif
     <table class="table">
         <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Permisos</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($users as $user)
                <tr>
                    <td> {{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay usuarios almacenados</td>
                </tr>
            @endforelse
         </tbody>
     </table>
    @if ($users->count())
        {{$users->link()}}
    @endif
</div>
@endsection

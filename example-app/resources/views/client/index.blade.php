@extends('theme.base')

@section('content')
    <div class="container py-5 text-center"> 
        <h1> Listado de clientes </h1>
        <a href="{{ route('client.create') }}" class="btn btn-primary">Crear clientes</a>
        @if (Session::has('mensaje'))
            <div class="alert alert-info my-5">
                {{Session::get('mensaje')}}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client) {{-- La coleccion que se iterara será la de clientes y lo almacenara en client--}}
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td> {{ $client->due}}</td>
                        <td>
                            <a href="{{ route('client.edit', $client) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('client.destroy', $client) }}" method="post" class="d-inline"> {{--Se pone inline para que lo deje sobre la misma linea, ya que form es en bloque--}}
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estas seguro de eliminar este cliente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>                  
                @empty
                <tr>
                    <td colspan="3">No hay registros</td> {{-- Si no se encuentran registros esta instrucccion se ejecuta--}}
                </tr> 
                @endforelse
            </tbody>
        </table>
        @if ($clients->count()) {{-- Si hay registros en la variable entonces haga--}}
            {{ $clients->links()}} {{-- Función para la paginación --}}
        @endif
    </div>
@endsection
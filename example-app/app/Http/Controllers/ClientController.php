<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('client.index')
            -> with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15',
            'due' => 'required|gte:1'
        ]); // Validar con la documentacion

        $client = Client::create($request->only('name', 'due', 'comments')); // Only solo para que se envien los datos que se necesitan 
        Session::flash('mensaje', 'Registro creado con éxito');
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.form')
                -> with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|max:15',
            'due' => 'required|gte:1'
        ]); // Validar con la documentacion
        // Forma individual
        //$client = Client::create($request->only('name', 'due', 'comments')); // Only solo para que se envien los datos que se necesitan 
        $client->name = $request['name'];
        $client->due = $request['due'];
        $client->comments = $request['comments'];
        $client->save(); // Almacena en la base de datos
        
        Session::flash('mensaje', 'Registro editado con éxito');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        Session::flash('mensaje', 'Registro eliminado con éxito');
        return redirect()->route('client.index');
    }
}
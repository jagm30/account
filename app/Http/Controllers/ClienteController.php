<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes')); 
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cliente::create($request->all());
        return json_encode(array(
            "Estado"=>"Agregado correctamente"
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $cliente    = DB::table('clientes')                                        
                    ->where('clientes.id',$id)
                    ->first();
            return json_encode($cliente);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }
    public function edicion(Request $request, $id_cliente, $apaterno, $amaterno, $nombre, $email, $telefono, $direccion, $ciudad, $estado)
    {             
        $cliente = Cliente::find($id_cliente);
        $cliente->apaterno  = $apaterno;
        $cliente->amaterno  = $amaterno;
        $cliente->nombre    = $nombre;
        $cliente->email     = $email;
        $cliente->telefono  = $telefono;
        $cliente->direccion = $direccion;
        $cliente->ciudad    = $ciudad;
        $cliente->estado    = $estado;
        $cliente->save();
        return response()->json(['data' => "Cambios guardados correctamente..."]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente   = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(['data' => "Eliminado correctamente..."]);
    }
}

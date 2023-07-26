<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return view('clientes.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->file('archivo')->store('public');
        //dd($request->file('cconstanciasituacion'));
        $cliente = Cliente::create($request->all());

        if($request->hasFile('constanciasituacion')){
            $cliente->constanciasituacion = $request->file('constanciasituacion')->store('public');
        }
        
        $user = User::create([
            'name'          => $request->nombre,
            'email'         => $request->email,
            'password'      => Hash::make($request->rfc),
            'tipo_usuario'  => 'cliente',
        ]);
        $user->roles()->attach(Role::where('name','cliente')->first());
        return $user;
        $cliente->id_user = $user->id;
        $cliente->save();
        return redirect()->route('clientes.index');

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
    public function edit(Request $request, $id)
    {

        $cliente    = Cliente::findOrFail($id);
        //return ;
        $usuario    = DB::table('clientes')
                    ->select('clientes.id as idcliente','clientes.email','users.name','users.email as emailuser','users.password')
                    ->leftJoin('users', 'clientes.id_user','=','users.id')
                    ->where('clientes.id',$id)
                    ->first();    
        //return $usuario;
            
            //->get(); 

        return view('clientes.edit', compact('cliente','usuario')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre        = $request->nombre;
        $cliente->email         = $request->email;
        $cliente->telefono      = $request->telefono;
        $cliente->razonsocial   = $request->razonsocial;
        $cliente->rfc           = $request->rfc;
        $cliente->domicilio     = $request->domicilio;
        $cliente->codigopostal  = $request->codigopostal;
        $cliente->emailfactura  = $request->emailfactura;
        
        
        $usuario = User::findOrFail($cliente->id_user);
        if ($request->password == ''){                        
        }else{
            $usuario->password         = Hash::make($request->password);
        }
        $usuario->email         = $request->usuario;
        $usuario->save();
//        return $usuario;

        if($request->hasFile('constanciasituacion')){
            $cliente->constanciasituacion = $request->file('constanciasituacion')->store('public');
        }
        $cliente->save();
        
        return redirect()->route('clientes.index');
        

    }
    public function edicion(Request $request, $id_cliente, $nombre, $email, $telefono, $razonsocial, $rfc, $domicilio, $codigopostal, $emailfactura)
    {             
        $cliente = Cliente::find($id_cliente);
        $cliente->nombre        = $nombre;
        $cliente->email         = $email;
        $cliente->telefono      = $telefono;
        $cliente->razonsocial   = $razonsocial;
        $cliente->rfc           = $rfc;
        $cliente->domicilio     = $domicilio;
        $cliente->codigopostal  = $codigopostal;
        $cliente->emailfactura  = $emailfactura;
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

<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;


class ServicioController extends Controller
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
        $servicios  = Servicio::all();
        $clientes   = Cliente::all();
        //return $usuarios;          
        return view('servicios.index', compact('servicios','clientes')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $clientes   = Cliente::all();
        return view('servicios.create', compact('date','clientes')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {              
            $servicio = Servicio::create($request->all());
            if($request->hasFile('contrato_doc')){
                $servicio->contrato_doc = $request->file('contrato_doc')->store('public');
            }            
            $servicio->save();        
            if(auth()->user()->tipo_usuario=='contador'){
                return redirect()->route('contador.index');        
            }else{
                return redirect()->route('servicios.index');        
            }
            
        } catch (\Exception $e) {
            
            return response()->json(['data' => $e->getMessage()]);  
        }         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $servicio    = Servicio::findOrFail($id);
        $clientes   = Cliente::all();
        return view('servicios.edit', compact('servicio','clientes')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->fecha_contrato   = $request->fecha_contrato;
        $servicio->descripcion      = $request->descripcion;
        $servicio->modalidad        = $request->modalidad;
        $servicio->id_cliente       = $request->id_cliente;
        $servicio->status           = $request->status;
        $servicio->fecha_finaliza   = $request->fecha_finaliza;
        $servicio->fecha_recurrente = $request->fecha_recurrente;
        $servicio->fechaf_recurrente= $request->fechaf_recurrente;
        $servicio->precio           = $request->precio;
        $servicio->id_usuario       = $request->id_usuario;
        
        

        if($request->hasFile('contrato_doc')){
            $servicio->contrato_doc = $request->file('contrato_doc')->store('public');
        }
        $servicio->save();
        
        return redirect()->route('servicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio   = Servicio::findOrFail($id);
        $servicio->delete();
        return response()->json(['data' => "Eliminado correctamente..."]);
    }

    public function estadoCuenta(Request $request, $id_usuario){

        $cliente = Cliente::where('id_user',$id_usuario)->first();

        $servicios = DB::table('servicios')
                        ->select('fecha_contrato','descripcion','servicios.precio','servicios.status','servicios.id as ids','pagoservicios.formapago','pagoservicios.fechapago')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->where('servicios.id_cliente',$cliente->id)
                        ->get();
        return view('servicios.estadocuenta', compact('servicios')); 
    }
    public function estadoCuentaAll(Request $request, $id_usuario){

        $cliente = Cliente::where('id_user',$id_usuario)->first();

        $servicios = DB::table('servicios')
                        ->select('fecha_contrato','descripcion','servicios.precio','servicios.status','servicios.id as ids','pagoservicios.formapago','pagoservicios.fechapago')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->where('servicios.id_cliente',$cliente->id)
                        ->get();
        return view('servicios.estadocuenta', compact('servicios')); 
    }
}

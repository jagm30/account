<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Catservicio;
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
        if(auth()->user()->tipo_usuario=='cliente'){
            $servicios  = DB::table('servicios')
                        ->select('servicios.id','fecha_contrato','servicios.descripcion','servicios.modalidad','servicios.id_cliente','servicios.contrato_doc','servicios.status','servicios.fecha_finaliza','servicios.fecha_recurrente','servicios.fechaf_recurrente','servicios.precio','servicios.id_usuario','catservicios.descripcion as desc_servicio')
                        ->leftjoin('catservicios','servicios.descripcion','=','catservicios.id')
                        ->leftjoin('clientes','servicios.id_cliente','=','clientes.id')
                        ->where('clientes.id_user',auth()->user()->id)
                        ->get();
            $clientes   = Cliente::all();
        }else{
            $servicios  = DB::table('servicios')
                        ->select('servicios.id','fecha_contrato','servicios.descripcion','servicios.modalidad','servicios.id_cliente','servicios.contrato_doc','servicios.status','servicios.fecha_finaliza','servicios.fecha_recurrente','servicios.fechaf_recurrente','servicios.precio','servicios.id_usuario','catservicios.descripcion as desc_servicio')
                        ->leftjoin('catservicios','servicios.descripcion','=','catservicios.id')
                        ->get();
            $clientes   = Cliente::all();
        } 
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
        $catservicios = Catservicio::all();     
        return view('servicios.create', compact('date','clientes','catservicios')); 
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
        $catservicios = Catservicio::all();   
        return view('servicios.edit', compact('servicio','clientes','catservicios')); 
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
                        ->select('fecha_contrato','catservicios.descripcion','servicios.precio','servicios.status','servicios.id as ids','pagoservicios.formapago','pagoservicios.fechapago','pagoservicios.status as statuspago')
                        ->leftjoin('catservicios','servicios.descripcion','=','catservicios.id')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->where('servicios.id_cliente',$cliente->id)
                        ->get();
        return view('servicios.estadocuenta', compact('servicios')); 
    }
    
}

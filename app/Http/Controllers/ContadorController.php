<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ContadorController extends Controller
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
        return view('contador.index', compact('clientes')); 
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contador  $contador
     * @return \Illuminate\Http\Response
     */
    public function show(Contador $contador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contador  $contador
     * @return \Illuminate\Http\Response
     */
    public function edit(Contador $contador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contador  $contador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contador $contador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contador  $contador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contador $contador)
    {
        //
    }
    public function createservicio(Request $request, $id_cliente){
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $cliente   = Cliente::findOrFail($id_cliente);
        return view('contador.createservicio', compact('date','cliente')); 
    }
    public function cuentasClientes(Request $request){
        //$cliente = Cliente::where('id_user',$id_usuario)->first();
        $servicios = DB::table('servicios')
                        ->select('clientes.nombre as nomcliente','fecha_contrato','descripcion','servicios.precio','fecha_finaliza','servicios.status','servicios.id as ids','pagoservicios.formapago','pagoservicios.fechapago','servicios.created_at as creacion')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->leftjoin('clientes','servicios.id_cliente','=','clientes.id')
                        ->get();
        //return $servicios;
        return view('contador.estadocuenta', compact('servicios'));
    }
    public function cuentaCliente(Request $request, $id){
        $servicio    = DB::table('servicios')
                        ->select('clientes.nombre as nomcliente','servicios.id_cliente','fecha_contrato','descripcion','servicios.precio','fecha_finaliza','servicios.status as statusservicio','servicios.id as ids','servicios.modalidad','servicios.fecha_recurrente','servicios.fechaf_recurrente','servicios.contrato_doc','pagoservicios.formapago','pagoservicios.fechapago','pagoservicios.status as statuspago','servicios.created_at as creacion','servicios.created_at as creacion')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->leftjoin('clientes','servicios.id_cliente','=','clientes.id')
                        ->where('servicios.id',$id)
                        ->first();
        $clientes   = Cliente::all();
        return view('contador.edit', compact('servicio','clientes')); 
    }
    
}
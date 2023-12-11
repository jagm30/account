<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Servicio;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // return view('home');
         if(auth()->user()->tipo_usuario=='cliente'){
            $servicios  = DB::table('servicios')
                        ->select('servicios.id','fecha_contrato','servicios.descripcion','servicios.modalidad','servicios.id_cliente','servicios.contrato_doc','servicios.status','servicios.fecha_finaliza','servicios.fecha_recurrente','servicios.fechaf_recurrente','servicios.precio','servicios.id_usuario','catservicios.descripcion as desc_servicio','pagoservicios.status as statuspago')
                        ->leftjoin('catservicios','servicios.descripcion','=','catservicios.id')
                        ->leftjoin('clientes','servicios.id_cliente','=','clientes.id')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->where('clientes.id_user',auth()->user()->id)
                        ->get();
            $clientes   = Cliente::all();
        }else{
            $servicios  = DB::table('servicios')
                        ->select('servicios.id','fecha_contrato','servicios.descripcion','servicios.modalidad','servicios.id_cliente','servicios.contrato_doc','servicios.status','servicios.fecha_finaliza','servicios.fecha_recurrente','servicios.fechaf_recurrente','servicios.precio','servicios.id_usuario','catservicios.descripcion as desc_servicio','pagoservicios.status as statuspago')
                        ->leftjoin('catservicios','servicios.descripcion','=','catservicios.id')
                        ->leftjoin('pagoservicios','servicios.id','=','pagoservicios.id_servicio')
                        ->get();
            $clientes   = Cliente::all();
        } 
        //return $usuarios;          
        return view('home', compact('servicios','clientes')); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pagoservicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class PagoservicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index";
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
        $pagoservicio = Pagoservicio::create($request->all());

        if($request->hasFile('comprobante')){
            $pagoservicio->comprobante = $request->file('comprobante')->store('public');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagoservicio  $pagoservicio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $servicio    = Servicio::findOrFail($id);
        $clientes   = Cliente::all();
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        return view('pagoservicios.show', compact('servicio','clientes','date')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagoservicio  $pagoservicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagoservicio $pagoservicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagoservicio  $pagoservicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagoservicio $pagoservicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagoservicio  $pagoservicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagoservicio $pagoservicio)
    {
        //
    }
}

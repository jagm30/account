<?php

namespace App\Http\Controllers;

use App\Models\Catservicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CatservicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catservicios = Catservicio::all();       
        return view('catservicios.index', compact('catservicios'));  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('catservicios.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $catservicio = Catservicio::create($request->all());
            return redirect()->route('catservicios.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catservicio  $catservicio
     * @return \Illuminate\Http\Response
     */
    public function show(Catservicio $catservicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catservicio  $catservicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
         $catservicio    = Catservicio::findOrFail($id);

        return view('catservicios.edit', compact('catservicio')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catservicio  $catservicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $catservicio = Catservicio::findOrFail($id);        
        $catservicio->descripcion      = $request->descripcion;
        $catservicio->save();        
        return redirect()->route('catservicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catservicio  $catservicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catservicio $catservicio)
    {
        //
    }
}

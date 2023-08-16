<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Usuario;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
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
        $usuarios = User::all();     
        //return $usuarios;          
        return view('usuarios.index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //para validar que tipo de usuarios pueden entrar a la vista o controlador
        $request->user()->authorizeRoles(['superadmin','admin']);
        return view('usuarios.create'); 
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
        //$request->user()->authorizeRoles(['admin']); 
        $user = User::create([
            'name'          => $request->nombre,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'tipo_usuario'  => $request->tipo_usuario,
        ]);
        $user->roles()->attach(Role::where('name',$request->tipo_usuario)->first());
        //return $user;

        return redirect()->route('usuarios.index');
      /*  return json_encode(array(
            "Estado"=>"Agregado correctamente"
        ));*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $usuario = DB::table('users')
                    ->where('users.id',$id)
                    ->first();
            return json_encode($usuario);
        }else{
            $usuario = User::find($id);
            return $usuario;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $usuario    = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

//        return $usuario;
        if ($request->password === 'ninguno'){
            $usuario = User::find($id);
            $usuario->name             = $request->nombre;
            $usuario->email            = $request->email;
            $usuario->tipo_usuario     = $request->tipo_usuario;
            $usuario->save();
        }else{
            $usuario = User::find($id);
            $usuario->name             = $request->nombre;
            $usuario->email            = $request->email;
            $usuario->tipo_usuario     = $request->tipo_usuario;
            $usuario->password         =  Hash::make($request->password);
            $usuario->save();
        }   
        
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */

    public function edicion(Request $request ,$id_usuario ,$nombre ,$email ,$password ,$tipo_usuario)
    { 
        if ($password === 'ninguno'){
            $usuario = User::find($id_usuario);
            $usuario->name             = $nombre;
            $usuario->email            = $email;
            $usuario->tipo_usuario     = $tipo_usuario;
            $usuario->save();
            return response()->json(['data' => "Cambios guardados correctamente..."]);
        }else{
            $usuario = User::find($id_usuario);
            $usuario->name             = $nombre;
            $usuario->email            = $email;
            $usuario->tipo_usuario     = $tipo_usuario;
            $usuario->password         =  Hash::make($password);
            $usuario->save();
            return response()->json(['data' => "Cambios guardados correctamente..."]);    
        }         
    }
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['superadmin']);
        $usuario   = User::find($id);
       /* if($usuario->tipo_usuario == 'superadmin'){
            return response()->json(['data' => "Eliminado correctamente..."]);
        }*/
        $usuario->delete();
        return response()->json(['data' => "Eliminado correctamente..."]);
    }
}
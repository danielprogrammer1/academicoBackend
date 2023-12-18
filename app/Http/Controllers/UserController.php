<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request
     * @return \Illuninate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs= $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $e = User::create($inputs);
        return response()->json([
            'data'=> $e,
            'mensaje' =>"Registrado con exito"
        ]);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = User::find($id);
        if (isset($e)){
            return response()->json([
                'data'=> $e,
                'mensaje' =>"Usuario encontrado"
            ]);
        }else{
            return response()->json([
                'error'=> true,
                'mensaje' =>"No existe el usuario"
            ]);
            
        }

    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $e = User::find($id);
        if (isset($e)){
            $e->first_name = $request->first_name;
            $e->last_name = $request->last_name;
            $e->email = $request->email;
            $e->password = Hash::make($request->password);
            if($e->save())
            {
                return response()->json([
                    'data'=> $e,
                    'mensaje' =>"Actualizado"
                ]);
                
            }else{
                return response()->json([
                    'error'=> true,
                    'mensaje' =>"No se pudo actuaizar"
                ]);
                
            }
        }else{
            return response()->json([
                'error'=> true,
                'mensaje' =>"No existe"
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id)
    {
        $e = User::find($id);
        if (isset($e)){
            $res = User::destroy($id);
            if($res){
                return response()->json([
                'data'=> $e,
                'mensaje' =>"Eiminado"
            ]);
            }else{
                return response()->json([
                'error'=> true,
                'mensaje' =>"No se ha eliminado"
                ]);
            }
            

        }else{
            return response()->json([
                'error'=> true,
                'mensaje' =>"No existe"
            ]);
            
        }
    }
}

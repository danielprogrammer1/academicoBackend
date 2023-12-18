<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a list of all students
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Store a new student
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs= $request->input();
        $e = Estudiante::create($inputs);
        return response()->json([
            'data'=> $e,
            'mensaje' =>"Estudiante creado con exito"
        ]);
    }

 /**
     * Update a student
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = Estudiante::find($id);
        if (isset($e)){
            return response()->json([
                'data'=> $e,
                'mensaje' =>"Estudiante encontrado"
            ]);
        }else{
            return response()->json([
                'error'=> true,
                'mensaje' =>"No existe el estudiante con id {$id}"
            ]);
            
        }

    }

    /**
     * Update a student
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $e = Estudiante::find($id);
        if (isset($e)){
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if($e->save())
            {
                return response()->json([
                    'data'=> $e,
                    'mensaje' =>"Estudiante actualizado"
                ]);
                
            }else{
                return response()->json([
                    'error'=> true,
                    'mensaje' =>"No se pudo actuaizar el estudiante"
                ]);
                
            }
        }else{
            return response()->json([
                'error'=> true,
                'mensaje' =>"No existe el estudiante"
            ]);
            
        }

    }

    
    /**
     * Remove a student
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $e = Estudiante::find($id);
        if (isset($e)){
            $res = Estudiante::destroy($id);
            if($res){
                return response()->json([
                'data'=> $e,
                'mensaje' =>"Estudiante eliminado"
            ]);
            }else{
                return response()->json([
                'error'=> true,
                'mensaje' =>"No se ha eliminado el estudiante"
                ]);
            }
            

        }else{
            return response()->json([
                'error'=> true,
                'mensaje' =>"No existe el estudiante con id {$id}"
            ]);
            
        }
    }
}
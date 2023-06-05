<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Categoria;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        //listar con sql
        // $categorias=DB::select("select * from categorias");

        // query builder 
        $categorias=DB::table("categorias")->get();

        return response()->json($categorias,200);
        //listar con query builder
    }

    /**
     * Show the form for creating a new resource.
     */
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // sql 
        //  DB::insert("insert into categorias (nombre,detalle) values(?,?)",[$request->nombre,$request->detalle]);

        //  query builder
        DB::table("categorias")->insert(['nombre'=>$request->nombre,'detalle'=>$request->detalle]);
         return response()->json(["messaje" => "categoria registrado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //consulta via sql 
        // $categoria=DB::select("select * from categorias where id=?",[$id]);

        // query builder
        $categoria=DB::table("categorias")->find($id);
        return response()->json($categoria,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //usamos eloquent
        $categoria=Categoria::find($id);
        $categoria->nombre=$request->nombre;
        $categoria->detalle=$request->detalle;
        $categoria->update();
        return response()->json(["messaje" => "categoria modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //usamos eloquent
        $categoria=Categoria::find($id);
        $categoria->destroy($id);
                return response()->json(["messaje" => "categoria eliminado"]);

    }
}

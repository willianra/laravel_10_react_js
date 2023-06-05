<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //eloquent 
        $user=User::get();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name"=>'required',
            "email"=>"required|email|unique:users,email",
            "password"=>"required"
        ]);
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json(["messaje" => "usuario registrado"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       $user= User::FindOrFail($id);
        return response()->json($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

                //
                $request->validate([
                    "name"=>'required',
                    "email"=>"required|email|unique:users,email,$id",
                    "password"=>"required"
                ]);
                $user= User::FindOrFail($id);
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->update();
                return response()->json(["messaje" => "usuario update"]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user= User::FindOrFail($id);
                $user->delete();
                return response()->json(["messaje" => "usuario eliminado"]);
    }
}

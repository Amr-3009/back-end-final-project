<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    

    /**
     * Register a newly created resource in storage.
     */
    public function register(Request $request){
        $validatedData = $request->validate([
            "name"=>"required|string|max:255",
            "email"=>"required|email|max:255|unique:users,email",
            "password"=>"required|string|max:255|min:8"
        ]);
        $validatedData['password']=Hash::make($validatedData['password']);
        $user=User::create($validatedData);
        return response()->json(["msg"=>"Registered Successfully"]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
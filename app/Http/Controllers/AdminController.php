<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            "name"=>"required|string|max:255",
            "email"=>"required|email|max:255|unique:users,email",
            "password"=>"required|string|max:255|min:8"
        ]);
        $validatedData['password']=Hash::make($validatedData['password']);
        $admin=Admin::create($validatedData);
        return response()->json(["msg"=>"Registered Successfully", "Admin"=>$admin]);
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            "email"=>"required|email|max:255",
            "password"=>"required|string|max:255|min:8"
        ]);
        $admin=Admin::where('email',$validatedData['email'])->first();
        if(!$admin || !Hash::check($validatedData['password'],$admin->password)){
            return response()->json(["msg"=>"Invalid Credentials"]);
        }
        
        $token = $admin->createToken("auth_token")->plainTextToken;
        $cookie = cookie("AdminToken",$token);
        return response()->json(["msg"=>"Login Successfully", "AdminToken"=>$token, "adminID"=>$admin->id]);
    }
}


// Path: app/Http/Controllers/AdminController.php
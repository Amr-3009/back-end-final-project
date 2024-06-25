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
        return User::all();
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
     * Login a newly created resource in storage.
     */
    public function login(Request $request){
        $validatedData = $request->validate([
            "email"=>"required|email|max:255",
            "password"=>"required|string|max:255|min:8"
        ]);
        $user=User::where('email',$validatedData['email'])->first();
        if(!$user || !Hash::check($validatedData['password'],$user->password)){
            return response()->json(["msg"=>"Invalid Credentials"]);
        }
        
        $token = $user->createToken("auth_token")->plainTextToken;
        $cookie = cookie("UserToken",$token);
        return response()->json(["msg"=>"Login Successfully", "UserToken"=>$token, "userID"=>$user->id]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|max:255|min:8'
        ]);
        if (isset($validatedData['name']) && !empty($validatedData['name'])) {
            $dataToUpdate['name'] = $validatedData['name'];
        }
        
        if (isset($validatedData['email']) && !empty($validatedData['email'])) {
            $dataToUpdate['email'] = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            if(!empty($validatedData['password'])){
                $validatedData['password'] = Hash::make($validatedData['password']);
            }else{
                unset($validatedData['password']);
            }
        }
        $user->update($validatedData);
        return response()->json(["msg" => "User Updated Successfully", "User" => $user]);
    }

    public function show(string $id)
    {
        return User::where('id', $id)->first();
    }
}
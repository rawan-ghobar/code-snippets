<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    function login(Request $request){
        $credentials = [
            "email" => $request["email"],
            "password"=> $request["password"]
        ];

        if (! $token = Auth::attempt($credentials)) {
           return Response::response(false ,"Invalid credentails");
        }

        $user = Auth::user();
        $user->token = $token;

        return Response::response(true,"Login Successful", $user);
    }

    function signup(Request $request){
        $user = new User;
        $user->username = $request["username"];
        $user->email = $request["email"];
        $user->password = bcrypt($request["password"]);
        $user->save();

        return Response::response(true,"Signup successful", [$user]);
    }

}

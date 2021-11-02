<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	$user = User::Create([
    		'name' => $request->input('name'),
    		'email' => $request->input('email'),
    		'password' => Hash::make($request->input('password'))
    	]);

    	return $user;

    }

    public function login(Request $request)
    {
    	if (!Auth::attempt($request->only('email','password'))){
    			return response([
    				'message' => 'Invalied Login'
    			], Response::HTTP_UNAUTHORIZED);
    	}
    	$user = Auth::User();

    	$token = $user->createToken('token')->plainTextToken;


    	$cookie = cookie('jwt', $token, 60*24);

    	return response([
    		'message' => 'Success'
    	])->withCookie($cookie);
    }

    public function user()
    {
    	return Auth::User();
    }
}

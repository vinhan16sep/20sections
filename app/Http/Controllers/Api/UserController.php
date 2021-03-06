<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function brandRegister(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 98
        ]);

        $user->save();

        return response()->json([
            'message' => 'User created'
        ], Config::get('constants.HTTP_STATUS.CREATED'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function brandLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Invalid Credentials'
                ], 401);
            }
        }catch (JWTException $e){
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }

        return response()->json([
            'message' => 'Signed in',
            'token' => $token
        ], Config::get('constants.HTTP_STATUS.OK'));
    }

    public function getPersonalInformation(){
        $user = JWTAuth::parseToken()->toUser();

        return response()->json([
            'data' => $user
        ], Config::get('constants.HTTP_STATUS.OK'));
    }
}
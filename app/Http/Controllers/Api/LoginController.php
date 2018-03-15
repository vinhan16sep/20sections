<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class LoginController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function brandLogin(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role' => 98])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Brand')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 200);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function brandRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 98;
        $user = User::create($input);
        $success['token'] =  $user->createToken('Brand')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     *
     * Publisher
     *
     */
    public function publisherLogin(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role' => 99])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Publisher')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 200);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function publisherRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $success =  false;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 99;
        if($user = User::create($input)){
            $success =  true;
            $success['token'] =  $user->createToken('Publisher')->accessToken;
        }

        return response()->json(['success'=>$success], $this->successStatus);
    }

}
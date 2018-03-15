<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(){
        $currentUser = app('Illuminate\Contracts\Auth\Guard')->user();
        return response()->json(['success' => $currentUser], $this->successStatus);
    }
}
<?php

namespace App\Http\Controllers;

use App\Demo;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DemoController extends Controller
{
    public function __construct(){

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDemos(){
        $demos = Demo::all();

        return response()->json(['demos' => $demos], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDemo(Request $request){

        $user = JWTAuth::parseToken()->toUser();

        $demo = new Demo();

        $demo->content = $request->input('content');
        $demo->save();

        return response()->json(['demo' => $demo, 'user' => $user], 201);
    }

    public function putDemo(Request $request, $id){
        $demo = Demo::find($id);

        if(!$demo){
            return response()->json(['message' => 'Document not found'], 404);
        }

        $demo->content = $request->input('content');
        $demo->save();

        return response()->json(['demo' => $demo], 200);
    }

    public function deleteDemo($id){
        $demo = Demo::find($id);

        if(!$demo){
            return response()->json(['message' => 'Document not found'], 404);
        }

        $demo->delete();

        return response()->json(['message' => 'Document deleted'], 200);
    }
}

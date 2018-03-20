<?php

namespace App\Http\Controllers;

use App\Demo;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function __construct(){

    }

    public function postDemo(Request $request){
        $demo = new Demo();

        $demo->content = $request->input('content');
        $demo->save();

        return response()->json(['demo' => $demo], 201);
    }

    public function getDemos(){
        $demos = Demo::all();

        return response()->json(['demos' => $demos], 200);
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

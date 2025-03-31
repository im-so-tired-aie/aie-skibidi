<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\programmes;
use Illuminate\Http\Request;

class Programmecontroller extends Controller
{
    //
    public function index(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $programmes = programmes::all();
            return response($programmes,200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\criteria;
use App\Models\User;
use Illuminate\Http\Request;

class Criteriacontroller extends Controller
{
    //
    public function index(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $criteria = criteria::all();
            return response($criteria,200);
        }
    }
    
}

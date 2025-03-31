<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\User;
use App\Models\enrolments;
use Illuminate\Http\Request;

class Categoriescontroller extends Controller
{
    //
    public function index(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $categories = categories::all();
            return response($categories,200);
        }
    }
}

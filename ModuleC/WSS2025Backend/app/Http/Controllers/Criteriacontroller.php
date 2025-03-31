<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\criteria;
use App\Models\programmes;
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

    public function manageview(){
        $clean_data = [];
        foreach(criteria::all() as $criteria){
            $transform = [];
            $transform["id"] = $criteria->id;  
            $transform["category"] = categories::where("id",$criteria->category_id)->first()->title;
            $transform["programme"] = programmes::where("id",$criteria->programme_id)->get()->first()->title;  
            $transform["required_hours"] = $criteria->required_hours;
            $transform["required_duration"] = $criteria->required_duration;
            $transform["required_project"] = $criteria->required_project;
            array_push($clean_data, $transform);
            
        }
        return view("criteria.index",["Criteria"=>$clean_data]);
    }
    public function createview(Request $request){
        return view("criteria.create");
    }
    
}

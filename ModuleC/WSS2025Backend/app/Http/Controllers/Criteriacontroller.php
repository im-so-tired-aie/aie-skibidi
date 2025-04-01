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
    
    public function create(Request $request){
        $request->category;
        $current_date = date('Y-m-d H:i:s');
        $criteria_submit["required_hours"] = $request->required_hours;
        $criteria_submit["required_duration"] = $request->required_duration;
        $criteria_submit["required_project"] = $request->required_project;
        $criteria_submit["created_at"] = $current_date;
        //todo: figure out what is needed to create a criteria and create it
        if (categories::where('title',$request->category)->first() == null) {
            $created_cat = categories::create(["title"=>$request->category,"created_at"=>$current_date]);
            $criteria_submit["category_id"] = $created_cat->id;
        }
        else{
            $criteria_submit["category_id"] =  categories::where('title',$request->category)->first()->id;
        }
        if(programmes::where('title',$request->programme)->first() == null){
            $created_prog = programmes::create(["title"=>$request->programme,"created_at"=>$current_date]);
            $criteria_submit["programme_id"] = $created_prog->id;
        }
        else{
            $criteria_submit["programme_id"] =  programmes::where('title',$request->programme)->first()->id;
        }   

        criteria::create($criteria_submit);
        return redirect("/admin/criteria")->with("flash","successfully created!");
    }
    public function delete($id){
        criteria::where("id",$id)->delete();
        return redirect("/admin/criteria")->with("flash","successful deleted ".$id);
    }
    public function edit($id,Request $request){
        $request->category;
        $current_date = date('Y-m-d H:i:s');
        $criteria_submit["required_hours"] = $request->required_hours;
        $criteria_submit["required_duration"] = $request->required_duration;
        $criteria_submit["required_project"] = $request->required_project;
        $criteria_submit["created_at"] = $current_date;
        //todo: figure out what is needed to create a criteria and create it
        if (categories::where('title',$request->category)->first() == null) {
            $created_cat = categories::create(["title"=>$request->category,"created_at"=>$current_date]);
            $criteria_submit["category_id"] = $created_cat->id;
        }
        else{
            $criteria_submit["category_id"] =  categories::where('title',$request->category)->first()->id;
        }
        if(programmes::where('title',$request->programme)->first() == null){
            $created_prog = programmes::create(["title"=>$request->programme,"created_at"=>$current_date]);
            $criteria_submit["programme_id"] = $created_prog->id;
        }
        else{
            $criteria_submit["programme_id"] =  programmes::where('title',$request->programme)->first()->id;
        }
        
        criteria::where("id",$id)->update($criteria_submit);
        return redirect("/admin/criteria")->with("flash","successful edit ".$id);
    }
    public function editview($id){
        foreach(criteria::where("id",$id)->get() as $criteria){
            $transform = [];
            $transform["id"] = $criteria->id;  
            $transform["category"] = categories::where("id",$criteria->category_id)->first()->title;
            $transform["programme"] = programmes::where("id",$criteria->programme_id)->get()->first()->title;  
            $transform["required_hours"] = $criteria->required_hours;
            $transform["required_duration"] = $criteria->required_duration;
            $transform["required_project"] = $criteria->required_project;
        }
        return view("criteria.edit",["criteria"=>$transform]);
    }
}


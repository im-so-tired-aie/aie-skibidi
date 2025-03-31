<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\criteria;
use App\Models\diary_entries;
use App\Models\enrolments;
use App\Models\programmes;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class Diarycontroller extends Controller
{
    //
    public function submit(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{

            $current_date = date('Y-m-d H:i:s');
            $diary_entries = $request->getContent();
            $diary_entries = json_decode($diary_entries,true);
            $diary_entries["current_date"] = $current_date;
            $diary_entries["enrolment_id"] = enrolments::where("user_id",$user->id)->first()->id;
            $responsed_diary = diary_entries::create($diary_entries);
            return response($responsed_diary,200);
        }
    }
    public function show(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $enroll_id = enrolments::where("user_id",$user->id)->first()->id;
            $diary_entries = diary_entries::where("enrolment_id",$enroll_id)->get();
            return response($diary_entries,200);
        }
    }
    public function approve($id, Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);
        }
        else if(strtolower($user->role) == "coordinator"){  
            diary_entries::where("id",$id)->update(["status"=>"Approved"]);
            return response(["message"=>"Diary entry approved"],200);
        }
        else{
            return response(["message"=>"Permission denied this action would be reported to admin."],403);
        }
    }

    public function reject($id, Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);
        }
        else if(strtolower($user->role) == "coordinator"){  
            diary_entries::where("id",$id)->update(["status"=>"Rejected"]);
            return response(["message"=>"Diary Entry rejected"],200);
        }
        else{
            return response(["message"=>"Permission denied this action would be reported to admin."],403);
        }
    }

    public function show_progress(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $enroll_id = enrolments::where("user_id",$user->id)->first()->id;
            $diary_entries = diary_entries::where("enrolment_id",$enroll_id)->where("status","Approved")->get();
            $programme = programmes::where("id",$user->programme_id)->first();
            $categories = [];
            foreach($diary_entries as $diary_entry){
                $category_id = $diary_entry->category_id;
                $title = categories::where("id",$category_id)->first()->title;
                $criteria = criteria::where("category_id",$category_id)->first();
                $required_hours = $criteria->required_hours;
                $required_duration = $criteria->required_duration;
                $completed_hours = $diary_entry->hours;
                $month = ((strtotime($diary_entry->end_date) - strtotime($diary_entry->start_date))/86400)/32;
                
                $categories[$title] = [
                    "completed hours"=>$completed_hours,
                    "completed_months"=>round($month ,0),
                    "required_hours"=>$required_hours,
                    "required_duration"=>$required_duration
                ] ;
            }
            $categories["title"] =  $programme;

            return response($categories,200);
        }
    }
}


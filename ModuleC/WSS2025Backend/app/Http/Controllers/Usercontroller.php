<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\criteria;
use App\Models\User;
use App\Models\enrolments;
use App\Models\programmes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{
    //
    public function auth(Request $request){
        return response(["name"=>$request->name],200);
    }
    public function register(Request $request){

        $original_data = (array)$request->all();
        $current_date = date('Y-m-d H:i:s');
        $clean_data = [];
        $clean_data["name"] = $original_data["name"];
        $clean_data["email"] = $original_data["email"];
        $clean_data["password"] =  $original_data["password"];
        $token = hash("sha256",($original_data["name"].$current_date).(string)random_int(1,69));
        $clean_data["role"] = $original_data['role'];
        $clean_data["remember_token"] = $token;
        $clean_data["created_at"] = $current_date;
        $user = User::create($clean_data);   
        $enroll_data = [];
        $enroll_data["name"] = $user->name;
        $enroll_data["email"] = $user->email;
        $enroll_data["address"] = $request->address;
        $enroll_data["nric"] = $request->nric;
        $enroll_data["contact_no"] = $request->contact_no;
        $enroll_data["dob"] = $request->dob;
        $enroll_data["gender"] = $request->gender;
        $enroll_data["race"] = $request->race;
        $enroll_data["nationality"] = $request->nationality;
        $enroll_data["programme_id"] = $request->programme_id;
        $enroll_data["created_at"] = $current_date; 
        $enroll_data["user_id"] = $user->id;
        $enrolments = enrolments::create($enroll_data);
        return response(["status"=>true,"message"=> "User created successfully.","token"=>$token,"id"=>$user->id],200);
    }
    public function login(Request $request){
        $user = User::where("email", $request->email)->first();
        if (Hash::check($request->password, $user->password)){
            $token = hash("sha256",($user->name.date('Y-m-d H:i:s')).(string)random_int(1,69));
            User::where('email', $request->email)->update(['remember_token'=>$token]);
            return response(["token"=>$token,"user"=>[
            "id"=>$user->id,
            "name"=>$user->name,
            "email"=>$user->email,
            "email_verified_at"=>$user->email_verified,
            "created_at"=> $user->created_at,
            "role"=> $user->role,
            "enrolment"=>enrolments::where("user_id", $user->id)->first(),
            ]],200);
        }
        else{
            return response(["status"=>false,"message"=>"invalid credentials"],403);
        }
    }

    public function destory(Request $request){
        User::where("id",$request->id)->delete();
        return response(["status"=>true],200);
    }
    public function create_test_prog(){
        $clean_data["title"] = "test1";
        $clean_data["created_at"] = "22-12-10";
        programmes::create($clean_data);
        categories::create($clean_data);
        categories::create($clean_data);
        categories::create($clean_data);

        //draft criteria data
        $criteria_data =[
            'category_id'=>"1",
            'programme_id'=>"1",
            'required_hours'=>"12",
            'required_duration'=>"2",
            'required_project'=>"5",
            'created_at'=>"2023-20-12",
        ];
        criteria::create($criteria_data);
        return response(["status"=>true,"message"=> "okay"],200);
    }

    public function logout(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $user->update(['remember_token'=>""]);
            return response(["message"=>"Logged out successfully. Token is now invalid."],200);
        }
    }
    public function user(Request $request){
        $token = $request->headers->get("Authorization");
        $user = User::where("remember_token",$token)->first();
        if ($user == null){
            return response(["message"=>"Invalid Token."],404);

        }
        else{
            $enrolment = enrolments::where("user_id",$user->id)->first();
            $user["enrolment"] = $enrolment;
            return response($user,200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiaryResource;
use App\Http\Resources\UserResource;
use App\Models\DiaryEntries;
use App\Models\Enrolments;
use App\Models\Programmes;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request) {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            $token = $user->createToken($request->email)->plainTextToken;
            $program = Programmes::where('id', $request->programme_id)->first();
            Enrolments::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_id' => $user->id,
                'nric' => $request->nric,
                'address' => $request->address,
                'contact_no' => $request->contact_no,
                "dob" => $request->dob,
                "gender" => $request->gender,
                "race" => $request->race,
                "nationality" => $request->nationality,
                "programme_id" => $program->id
            ]);

            return response()->json([
                "status" => true,
                "message" => "User created successfully",
                "token" => $token,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request) {
        try {
            $user = User::where("email", $request->email)->first();
            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found",
                ], 404);
            }

            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    "status" => false,
                    "message" => "Incorrect password",
                ], 403);
            }

            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json([
                "token" => $token,
                "user" => new UserResource($user)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Logged out successfully. Token is now invalid."
        ]);
    }

    public function show(Request $request) {
        return response()->json(new UserResource($request->user()));
    }
}

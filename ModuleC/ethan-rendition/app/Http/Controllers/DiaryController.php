<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiaryResource;
use App\Models\Categories;
use App\Models\Criteria;
use App\Models\DiaryEntries;
use Illuminate\Http\Request;
use Exception;

class DiaryController extends Controller
{
    public function create(Request $request)
    {
        try {
            $diary = DiaryEntries::create([
                'title' => $request->title,
                'description' => $request->description,
                'organization' => $request->organization,
                'reflection' => $request->reflection,
                'status' => 'Pending',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'hours' => $request->hours,
                'remarks' => $request->remarks,
                'enrolment_id' => $request->user()->enrolment->id,
                'category_id' => $request->category_id,
            ]);

            return response()->json($diary, 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function diariesByEnrolment(Request $request) {
        try {
            $enrolment = auth()->user()->enrolment;
            return response()->json(DiaryResource::collection($enrolment->diaries), 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function diariesProgressByEnrolment(Request $request) {
        try {
            $enrolment = auth()->user()->enrolment;
            $program = $enrolment->program;
            $categoryList = Categories::all();
            $categories = [];
            foreach ($categoryList as $category) {
                $criteria = Criteria::query()->where('programme_id', $program->id)->where('category_id', $category->id)->first();
                $diaries = DiaryEntries::query()->where('enrolment_id', $enrolment->id)->where('category_id', $category->id)->first();
                $categories[$category->title] = [
                    "completed_hours" => 0,
                    "completed_months" => 1,
                    "required_hours" => $criteria->required_hours,
                    "required_duration" => $criteria->required_duration,
                ];
            }
            return response()->json([
                "programme" => $program->title,
"enrolment" => $enrolment,
//                "criteria" => $criteria,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function approve(int $id) {
        try {
            $diary = DiaryEntries::where('id', $id)->firstOrFail();
            $diary->update([
                'status' => 'Approved',
            ]);
            return response()->json([
                'message' => 'Diary entry approved',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function reject(int $id) {
        try {
            $diary = DiaryEntries::where('id', $id)->firstOrFail();
            $diary->update([
                'status' => 'Rejected',
            ]);
            return response()->json([
                'message' => 'Diary entry rejected',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

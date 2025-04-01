<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriteriaResource;
use App\Models\Criteria;
use Exception;

class CriteriaController extends Controller
{
    public function index() {
        try {
            return response()->json(CriteriaResource::collection(Criteria::all()));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

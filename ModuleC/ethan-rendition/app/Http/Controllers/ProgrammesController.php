<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriteriaResource;
use App\Models\Programmes;
use Illuminate\Http\Request;

class ProgrammesController extends Controller
{
    public function index() {
        return response()->json(Programmes::all());
    }
}

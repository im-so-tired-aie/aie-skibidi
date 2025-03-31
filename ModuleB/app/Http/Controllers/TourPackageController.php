<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourPackageController extends Controller
{
    public function index() {
        $folders = [];
        $retrievedFolders = Storage::disk('public')->directories('resources');
        foreach ($retrievedFolders as $folder) {
            $folderName = explode("/", $folder)[1];
            $folders[$folderName] = FileController::parseDirectory($folder);
        }
    }

    public function show() {

    }
}

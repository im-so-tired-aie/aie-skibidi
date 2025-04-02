<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourPackageController extends Controller
{
    public function index() {
        $directories = Storage::disk('public')->directories('resources');
        $indexed = [];
        foreach ($directories as $directory) {
            $directoryName = basename($directory);
            $indexed[$directoryName] = FileController::parseDirectory($directory);
        }

        return view('index', [
            "locations" => $indexed
        ]);
    }

    public function show(string $path) {
        $file = FileController::parsePackageDirectory("resources/" . $path);
        return view('show', [
            "package" => $file
        ]);
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        $directory = Storage::disk('public')->directories('resources/' . $request->country);
        $newDirName = "Package" . count($directory) + 1;
        $dirPath = 'resources/' . $request->country . "/" . $newDirName;
        Storage::disk('public')->makeDirectory($dirPath);
        if ($request->hasFile('cover')) {
            Storage::disk('public')->putFileAs($dirPath, $request->file('cover'), "cover.". $request->file('cover')->getClientOriginalExtension());
        }

        if ($request->hasFile('img1')) {
            Storage::disk("public")->putFileAs($dirPath, $request->file("img1"), "img1.". $request->file("img1")->getClientOriginalExtension());
        }

        if ($request->hasFile('img2')) {
            Storage::disk("public")->putFileAs( $dirPath, $request->file("img2"), "img2.". $request->file("img2")->getClientOriginalExtension());
        }

        if ($request->hasFile('img3')) {
            Storage::disk("public")->putFileAs($dirPath, $request->file("img3"), "img3.". $request->file("img3")->getClientOriginalExtension());
        }

        Storage::disk("public")->put($dirPath . "/info.md", $request["content"]);

        return redirect("/");
    }
}

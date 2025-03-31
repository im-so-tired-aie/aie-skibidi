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

        return view("tourpackage.index", [
            "folders" => $folders
        ]);
    }

    public function show(string $path) {
        $parsedFile = FileController::parseDirectory("resources/{$path}");
        return view("tourpackage.show", [
            "package" => $parsedFile
        ]);
    }

    public function create() {
        return view("tourpackage.create");
    }

    public function store(Request $request) {
        $attr = $request->validate([
            "content" => "required",
            "country" => "required",
            "cover" => ["required", "image"],
            "img1" => ["nullable", "image"],
            "img2" => ["nullable", "image"],
            "img3" => ["nullable", "image"],
        ]);

        $retrievedFolders = Storage::disk('public')->directories('resources/' . $request->country);
        $newPackageFolderName = 'resources/' . $request->country . "/" . "Package" . count($retrievedFolders) + 1;
        Storage::makeDirectory($newPackageFolderName);
        $files = ['cover', 'img1', 'img2', 'img3'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $extension = $request->file($file)->getClientOriginalExtension();
                Storage::disk('public')->putFileAs(
                    $newPackageFolderName,
                    $request->file($file),
                    "{$file}.{$extension}"
                );
            }
        }
        Storage::disk("public")->put("$newPackageFolderName/info.md", $attr["content"]);
        return redirect("/");
    }
}

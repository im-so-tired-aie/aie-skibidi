<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormattedPackage {
    public string $title;
    public string $highlights;
    public string $departureDates;
    public string $duration;
    public string $cost;
    public string $coverImage;
    public string $images;
    public string $content;
}

class FileController extends Controller
{
    public static function parseDirectory(string $directoryPath) {
        $retrievedPackages = Storage::disk('public')->directories($directoryPath);
        $packages = [];
        foreach ($retrievedPackages as $retrievedPackage) {
            $files = Storage::disk('public')->files($retrievedPackage);

            $formattedPackage = new FormattedPackage();
            foreach ($files as $file) {
                if (str_contains($file, "cover.")) {
                    $formattedPackage->coverImage = $file;
                } else if (str_contains($file, "img")) {
                    if (isset($formattedPackage->images)) {
                        $formattedPackage->images = $formattedPackage->images . "," . $file ;
                    } else {
                        $formattedPackage->images = $file;
                    }
                } else if (str_contains($file, "info.md")) {
                    $readFile = FileController::handleFile($file);
                }
            }
        }
        dd($retrievedPackages);
    }
    public static function handleFile(string $filePath) {
        $file = Storage::disk('public')->get($filePath);
//        dd($filePath);
        // Retrieve all the front matter info
        $frontMatter = explode("\r\n", explode("<!-- End of front matter -->", $file)[0]);
        dd($frontMatter);
    }
    public static function formatFileContents() {

    }
}

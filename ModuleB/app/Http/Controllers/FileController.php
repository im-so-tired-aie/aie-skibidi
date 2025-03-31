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
                    $readFile = self::handleFile($file);

                    $formattedPackage->title = $readFile['title'];
                    $formattedPackage->highlights = $readFile['highlights'];
                    $formattedPackage->departureDates = $readFile['departureDates'];
                    $formattedPackage->duration = $readFile['duration'];
                    $formattedPackage->cost = $readFile['cost'];
                    $formattedPackage->content = $readFile['content'];
                }
            }
            $packages[] = $formattedPackage;
        }
        return $packages;
    }
    public static function handleFile(string $filePath) {
        $file = Storage::disk('public')->get($filePath);
        // Retrieve all the front matter info
        $data = [];
        $frontMatter = explode("\r\n", explode("<!-- End of front matter -->", $file)[0]);
        foreach ($frontMatter as $line) {
            if (str_contains($line, "**Title**: ")) {
                $data["title"] = explode("**Title**: ", $line)[1];
            } else if (str_contains($line, "**Highlights**: ")) {
                $data["highlights"] = explode("**Highlights**: ", $line)[1];
            } else if (str_contains($line, "**Departure Dates**: ")) {
                $data["departureDates"] = explode("**Departure Dates**: ", $line)[1];
            } else if (str_contains($line, "**Duration**: ")) {
                $data["duration"] = explode("**Duration**: ", $line)[1];
            } else if (str_contains($line, "**Cost**: ")) {
                $data["cost"] = explode("**Cost**: ", $line)[1];
            }
        }
        $data["content"] = self::formatFileContents(explode("<!-- End of front matter -->", $file)[1]);

        return $data;
    }
    public static function formatFileContents(string $unformattedContents) {
        $splittedContents = explode("\r\n", $unformattedContents);
        $content = [];
        foreach ($splittedContents as $line) {
            // Format .md into HTML format
            $text = $line;
            preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $text);
            if (str_contains($line, "## ")) {
                $content[] = "<h2>" . str_replace("## ", "", $text) . "</h2>";
            }
            if (str_contains($line, "# ")) {
                $content[] = "<h1>" . str_replace("# ", "", $text) . "</h1>";
            }
            if (str_contains($line, "- ")) {
                $content[] = "<li>" . str_replace("- ", "", $text) . "</li>";
            }
        }
        return join("", $content);
    }
}

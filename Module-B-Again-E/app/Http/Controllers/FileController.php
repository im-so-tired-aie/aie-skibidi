<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileData {
    public string $title;
    public string $highlights;
    public string $departureDates;
    public string $duration;
    public string $cost;
    public string $content;
    public string $cover;
    public string $img1;
    public string $img2;
    public string $img3;
    public string $path;
}

class FileController extends Controller
{
    public static function parseDirectory(string $directory) {
        $directories = Storage::disk("public")->directories($directory);
        $info = [];
        foreach ($directories as $d) {
            $packageName = basename($d);
            $info[$packageName] = self::parsePackageDirectory($d);
        }
        return $info;
    }

    public static function parsePackageDirectory(string $directory) {
        $fileData = new FileData();
        $files = Storage::disk("public")->files($directory);
        $fileData->path = preg_replace("#^\w+/(.*)$#", "$1", $directory);
        foreach ($files as $file) {
            $fileName = basename($file);
            if (str_contains($fileName, "cover")) {
                $fileData->cover = $file;
            } else if (str_contains($fileName, "img1")) {
                $fileData->img1 = $file;
            } else if (str_contains($fileName, "img2")) {
                $fileData->img2 = $file;
            } else if (str_contains($fileName, "img3")) {
                $fileData->img3 = $file;
            } else if (str_contains($fileName, "info.md")) {
                $data = self::parseInfoFile(Storage::disk("public")->get($file));
                $fileData->title = $data->title;
                $fileData->highlights = $data->highlights;
                $fileData->departureDates = $data->departureDates;
                $fileData->duration = $data->duration;
                $fileData->cost = $data->cost;
                $fileData->content = $data->content;
            }
        }
        return $fileData;
    }

    public static function parseInfoFile(string $content) {
        $fileData = new FileData();
        $splittedContent = explode("<!-- End of front matter -->", $content);
        $frontMatter = $splittedContent[0];
        $unstructuredContent = $splittedContent[1];
        foreach (explode("\r\n", "$frontMatter") as $line) {
            if (str_contains($line, "**Title**: ")) {
                $fileData->title = str_replace("**Title**: ", "", $line);
            } else if (str_contains($line, "*Departure Dates*")) {
                $fileData->departureDates = str_replace("**Departure Dates**: ", "", $line);
            } else if (str_contains($line, "*Highlights*")) {
                $fileData->highlights = str_replace("**Highlights**: ", "", $line);
            } else if (str_contains($line, "*Duration*")) {
                $fileData->duration = str_replace("**Duration**: ", "", $line);
            } else if (str_contains($line, "*Cost*")) {
                $fileData->cost = str_replace("**Cost**: ", "", $line);
            }
        }

        $fileData->content = Str::markdown($unstructuredContent);

//        $newContent = [];
//        foreach(explode("\r\n", $unstructuredContent) as $line) {
//            $text = $line;
//            preg_replace("/\*\*(.*)\*\*/", "<b>$1</b>", $text);
//            if (str_contains($line, "#")) {
//                $newContent[] = "<h1>" . str_replace("#", "", $line) . "</h1>";
//            } else if (str_contains($line, "##")) {
//                $newContent[] = "<h2>" . str_replace("##", "", $line) . "</h2>";
//            } else if (str_contains($line, "- ")) {
//                $newContent[] = "<li>" . str_replace("- ", "", $line) . "</li>";
//            }
//        }
//        $fileData->content = join("", $newContent);
        return $fileData;
    }
}

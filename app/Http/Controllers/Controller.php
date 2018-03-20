<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function buildUniqueSlug($table, $id, $slug){
        $slugCount = count(DB::table($table)->select('*')->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and 'id' != '{$id}'")->get());
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

    protected function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }

    protected function buildNewFolderPath($path, $fileName){
        $newPath = $path . '/' . $fileName;
        $newName = $fileName;
        $counter = 1;
        while (file_exists($newPath)) {
            $newName = $counter . '-' . $fileName;
            $newPath = $path . '/' . $newName;
            $counter++;
        }

        return array($newName, $newPath);
    }
}

<?php 

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadImages 
{
    public $files;

    public function uploadImageFiles($files)
    {
        foreach($files as $file){
            $path = $file->store('images','public');
            $filename = basename($path);
            $images[] = $filename;
        }
        $file_names = implode(',', $images);
        return $file_names;
    }

}
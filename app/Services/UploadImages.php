<?php 

namespace App\Services;

class UploadImages 
{
    public $files;

    public function uploadImageFiles($files)
    {
        foreach($files as $file){
            $folder = public_path('category_images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($folder, $filename);
            $images[] = $filename;
        }
        $file_names = implode(',', $images);
        return $file_names;
    }

}
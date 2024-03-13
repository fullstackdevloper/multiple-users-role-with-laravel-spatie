<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Services\UploadImages;


class CategoryRepository extends BaseRepository {

    public $uploadImages;
    public function __construct(Categories $category ,UploadImages $uploadImages) {
        parent::__construct($category);
        $this->uploadImages = $uploadImages;
    }
    public function addCategory($category)
    {
        $files  = $this->uploadImages->uploadImageFiles($category['images']);
        $category = $this->create(['title' => $category['title'],'description'=> $category['description'],'images'=>$files]);
        return $category;
    }
    public function destroyCategory($id){
        $category = $this->deleteById($id);
        return $category;
    }
    public function updateCategory($id , $category){

        if (!empty($category['images'])) {
            $files = $this->uploadImages->uploadImageFiles($category['images']);
        }else{
            $images = $this->find($id);
            $files = $images->images;
        }
        $updated = $this->updateByCriteria(['id'=>$id],['title'=>$category['title'],'description'=>$category['description'],'images'=>$files]);
        return $updated;
    }
}
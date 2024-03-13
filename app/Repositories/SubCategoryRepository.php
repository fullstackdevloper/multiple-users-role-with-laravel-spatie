<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Models\SubCategory;
use App\Services\UploadImages;


class SubCategoryRepository extends BaseRepository {

    public $uploadImages;
    public function __construct(SubCategory $subcategory ,UploadImages $uploadImages) {
        parent::__construct($subcategory);
        $this->uploadImages = $uploadImages;
    }
    public function addSubcategory($subcategory)
    {
        $subcategory = $this->create(['title' => $subcategory['title'],'description'=> $subcategory['description'],'category_id'=>$subcategory['category']]);
        return $subcategory;
    }
    public function destroySubCategory($id){
        $category = $this->deleteById($id);
        return $category;
    }
    public function updateSubCategory($id , $subcategory){
        $updated = $this->updateByCriteria(['id'=>$id],['title'=>$subcategory['title'],'description'=>$subcategory['description'],'category_id'=>$subcategory['category']]);
        return $updated;
    }
}
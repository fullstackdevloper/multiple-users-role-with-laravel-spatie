<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'images',
    ];

    public function subCategory(){
       return $this->hasOne(SubCategory::class,'category_id','id');
    }
}

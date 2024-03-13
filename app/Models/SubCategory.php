<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category_id'
    ];
    public function category(){
        return $this->belongsTo(Categories::class,'category_id','id');
    }
    public function events(){
        return $this->hasOne(Events::class,'subcategory_id','id');
    }
}

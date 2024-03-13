<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'images',
        'start_time',
        'end_time',
        'images',
        'subcategory_id',
        'fee_per_seat',
        'seats_available'
    ];


    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "parent_id"
    ];


    function parent(){
        return $this->belongsTo(Category::class,"parent_id","id");
    }

    function children(){
        return $this->hasMany(Category::class,"parent_id","id")->with("children");
    }

    function news(){
        return $this->hasMany(News::class,"category_id","id");
    }
}

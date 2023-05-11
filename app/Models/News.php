<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;


    public $fillable = [
        "title",
        "image",
        "en_title",
        "description",
        "long_description",
        "views",
    ];


    public function comments(){ // اگر فیلد رابطه در جدول مقابل است از متد has many استفاده میشود
        return $this->hasMany(Comment::class,"news_id");
    }
}

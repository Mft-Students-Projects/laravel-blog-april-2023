<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $fillable = ["name","content","parent_id","news_id"];


    public function children(){
        return $this->hasMany(Comment::class,"parent_id");
    }
}

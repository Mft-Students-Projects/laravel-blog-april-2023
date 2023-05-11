<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $fillable = ["name","content","parent_id","news_id","confirmed"];

    public function children(){
        return $this->hasMany(Comment::class,"parent_id");
    }

    public function news(){// اگر فیلد رابطه در جدول فعلی است از متد belongsTo استفاده میشود
        return $this->belongsTo(News::class,"news_id");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($id){
        $news = News::findorfail($id);
        return view("news",compact("news"));
    }
}

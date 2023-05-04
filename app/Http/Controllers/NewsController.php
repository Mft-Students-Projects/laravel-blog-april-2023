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

    public function search(Request $request){
        // query string
        if($request->has("q")){
            $result_news = News::where("title","LIKE","%".$request->q."%")->get();
            return view("search",compact("result_news"));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($id){
        $news = News::with(["comments"=>function($query){
            $query->where("parent_id",null)->with("children");
        }])->findorfail($id);
        return view("news",compact("news"));
    }

    public function search(Request $request){
        // query string
        if($request->has("q")){
            $result_news = News::where("title","LIKE","%".$request->q."%")->get();
            return view("search",compact("result_news"));
        }
    }

    public function saveComment($id,Request $request){

        $request->validate([
            "name"=>"required|string|min:2|max:100",
            "content"=>"required|string|min:5|max:500",
            "parent_id"=>"nullable|integer|exists:comments,id"
        ]);

        $news = News::findorfail($id);

        $request->request->add(["news_id"=>$id]);

        Comment::create($request->all());

        return redirect()->back();
    }
}

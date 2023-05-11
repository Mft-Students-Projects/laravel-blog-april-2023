<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class DashboardCommentController extends Controller
{
    public function replies($id){

        $comment = Comment::findorfail($id);

        $replies = Comment::where("parent_id",$id)
            ->orderBy("id","DESc")
            ->get();

        return view("dashboard.comments.replies",compact("comment","replies"));

    }



    public function index(Request $request){

//        if($request->has("is_confirmed") && $request->is_confirmed){
//            $comments = Comment::where("confirmed",1)->orderBy("created_at","DESc")->get();
//        }else{
//            $comments = Comment::where("confirmed",0)->orderBy("created_at","DESc")->get();
//        }

        $comments = Comment::with("news")->where("parent_id",null)->where("confirmed",$request->has("is_confirmed") && $request->is_confirmed == 1)
            ->orderBy("id","DESc")
            ->get();

//        return $comments;

        return view("dashboard.comments.index",compact("comments"));

    }


    public function confirm($id,Request $request){
        $comment = Comment::findorfail($id);

//        if($request->has("rejected")){
//            $comment->update(["confirmed"=>0]);
//
//            session()->flash("success","دیدگاه تایید شد");
//        }else{
//            $comment->update(["confirmed"=>1]);
//
//            session()->flash("success","دیدگاه تایید شد");
//        }

        $comment->update(["confirmed"=>!$request->has("rejected")]);

        session()->flash("success","دیدگاه ".($request->has("rejected") ? "رد شد" : "تایید شد"));

        return redirect()->back();
    }


    public function create(){

    }


    public function store(){

    }


    public function edit(){


    }


    public function update(){


    }


    public function destroy($id){

        $comment = Comment::findorfail($id);

        $comment->delete();

        session()->flash("success","دیدگاه حذف شد");

        return redirect()->back();

    }
}

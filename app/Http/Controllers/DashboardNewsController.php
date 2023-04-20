<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class DashboardNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = News::all();
        return view("dashboard.news.index",compact("news"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view("dashboard.news.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            "title"=>"required|string|min:2|max:255",
            "en_title"=>"required|string|min:2|max:255",
            "description"=>"required|string|min:2|max:255",
            "long_description"=>"required|string|min:10|max:65000",
            "image"=>"required|file|mimes:png,jpg,jpeg|max:256",
            "category_id"=>"required|integer|exists:categories,id"
        ]);

        $file = $request->file("image");

        $md5 = md5(time().rand(1000,99999));

        $fileName = $md5.".".$file->getClientOriginalExtension();

//        dd($md5.".".$file->getClientOriginalExtension());
//        $file->move(public_path("/media"),$file->getClientOriginalName().".".$file->getClientOriginalExtension());
        if(!$file->move(public_path("media"),$fileName)){
            session()->flash("error","مشکلی در آپلود فایل ");
            return redirect(route("news.create"));
        }

        $data = $request->all();

        $data["image"] = $fileName;

        News::create($data);

        return redirect(route("news.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = Category::all();
        $news = News::findorfail($id); //404
        return view("dashboard.news.edit",compact("categories","news"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title"=>"required|string|min:2|max:255",
            "en_title"=>"required|string|min:2|max:255",
            "description"=>"required|string|min:50|max:255",
            "long_description"=>"required|string|min:2|max:65000",
            "category_id"=>"required|integer|exists:categories,id"
        ]);

        News::findorfail($id)->update($request->all());

        session()->flash("success","خبر ویرایش شد !");

        return redirect(route("news.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $news = News::find($id);
        if($news){
            $news->delete();
        }
        session()->flash("success","خبر حذف شد");
        return redirect(route("news.index"));
    }
}

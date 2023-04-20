<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        return response()->json(Category::with("children")->where("parent_id",null)->get());

        $homeCategories = Category::with("news")->where("parent_id",null)->get();
        $latest = News::orderBy("id","DESC")->limit(5)->get();

//        dd($latest);
        return view('welcome',compact("latest","homeCategories"));
    }
}

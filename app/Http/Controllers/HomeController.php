<?php

namespace App\Http\Controllers;

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
        $latest = News::orderBy("id","DESC")->limit(5)->get();

//        dd($latest);
        return view('welcome',compact("latest"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $categories = Category::with("parent")->get();

//        Debugbar::error($categories);

        if($request->wantsJson()){
            return CategoriesResource::collection($categories);
        }

        return view("dashboard.categories.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $root_categories = Category::where("parent_id",null)->get();
        return view("dashboard.categories.create",compact("root_categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

//        dd($request->all());

        if($request->has("parent_id") && $request->parent_id == ""){
            $request->request->add(["parent_id"=>null]);
        }

        $request->validate([
            "title"=>"required|string|min:2|max:80",
            "parent_id"=>"nullable|exists:categories,id"
        ]);

        $category = Category::create($request->all());

        if($request->wantsJson()){
            return $category;
        }

        return redirect(route("categories.index"));

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
        $root_categories = Category::where("parent_id",null)->get();
        $category = Category::findorfail($id); //404
        return view("dashboard.categories.edit",compact("root_categories","category"));
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
        if($request->has("parent_id") && $request->parent_id == ""){
            $request->request->add(["parent_id"=>null]);
        }

        $request->validate([
            "title"=>"required|string|min:2|max:80",
            "parent_id"=>"nullable|exists:categories,id"
        ]);

        $category = Category::findorfail($id)->update($request->all());


        if($request->wantsJson()){
           return $category;
        }

        session()->flash("success","دسته بندی ویرایش شد !");
        return redirect(route("categories.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        if($category){
            $category->delete();
        }
        session()->flash("success","دسته بندی حذف شد");
        return redirect(route("categories.index"));
    }
}

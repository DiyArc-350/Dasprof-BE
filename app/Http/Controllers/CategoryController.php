<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $category = Category::all();
        $photo = Photo::all();

        return view('admin.dashboard', ['title'=>'Admin Dashboard','category'=>$category, 'photo'=>$photo]);
    }


    public function index(){
        $category = Category::all();
        return view('admin.categoryList', ['title' => 'Category', 'category'=>$category]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields= $request->validate([
            'category_name' => 'required|string',
            'category_code' => 'required|string|unique:category,category_code',
            'category_desc' => 'required|string'
        ]) ;
        $fields['created_at'] = now();
        $fields['updated_at'] = now();

        Category::create($fields);
        return redirect()->back(); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $fields = $request->validate([
            'category_name' => 'required|string',
            'category_code' => 'required|string',
            'category_desc' => 'required|string'
        ]);
        $category->updated_at = now();

        $category->update($fields);

        return redirect()->back(); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
    public function index()
    {
        $data = Category::all()->sortBy('category_name');
        return view('category_index', compact('data'));
    }

  
    public function create()
    {
        return view('category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_name = $request->input('category_name');
        $check = DB::table('categories')->where('category_name',$category_name)->count();
        if($check){
            return redirect('/category/create')->withErrors(['Category Name already exist!']);
        }else{
            $data = $request->validate([
                'category_name' => 'required|max:255',
            ]);
            $category = Category::create($data);            
            return redirect('/category/create')->withErrors('Category has been saved!');
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('category_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'category_name' => 'required|max:255|unique:categories',
        ]);
        Category::whereId($id)->update($data);

        return redirect('/category')->withErrors('Category has been updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $subcategory = DB::table('subcategories')->where('category_id',$id)->count();
        if($subcategory){
            return redirect('/category')->withErrors('You can not delete this category because Sub Category belongs to this category. You have to delete sub category first.');
        }else{
            $category->delete();
            return redirect('/category')->withErrors('Category has been deleted!');
        }
        
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}

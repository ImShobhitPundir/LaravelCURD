<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('subcategories')->join('categories', 'subcategories.category_id', '=', 'categories.id')->select('subcategories.*', 'categories.category_name')->get();
        return view('subcategory_index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all()->sortBy('category_name');
        return view('subcategory',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_id = $request->input('category_id');
        $sub_category_name = $request->input('sub_category_name');        
            $data = $request->validate([
                'category_id' => 'required|max:255',
                'sub_category_name' => 'required|max:255',
            ]);
            Subcategory::create($data);            
            return redirect('/subcategory/create')->withErrors('Sub Category has been created!');
        
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::all()->sortBy('category_name');
        $data = DB::table('subcategories')->join('categories', 'subcategories.category_id', '=', 'categories.id')->select('subcategories.*', 'categories.category_name')->where('subcategories.id',$id)->get();
        //dump($data); die;
        return view('subcategory_edit', compact('data','cat'));
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
                'category_id' => 'required|max:255',
                'sub_category_name' => 'required|max:255',
            ]);
        Subcategory::whereId($id)->update($data);

        return redirect('/subcategory')->withErrors('Sub Category has been updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return redirect('/subcategory')->withErrors('Sub Category has been deleted!');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}

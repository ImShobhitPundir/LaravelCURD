<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = DB::table('categories')->count();
        $subcategory = DB::table('subcategories')->count();
        $product = DB::table('products')->where('user_id',Auth::user()->id)->count();
        return view('home',compact('category','subcategory','product'));
    }
}

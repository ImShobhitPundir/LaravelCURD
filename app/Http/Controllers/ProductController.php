<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
                ->select('products.*', 'categories.category_name', 'subcategories.sub_category_name')
                ->where('products.user_id',Auth::user()->id)
                ->get();
               // dump($data);
                //die;
        return view('product_index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all()->sortBy('category_name');;
        return view('product',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'mimes:jpeg,png|max:1014',
        ]);
        //$extension = $request->image->extension(); 
        $imageName = time().'.'.$request->image->extension(); 
        $request->image->storeAs('uploads', $imageName, 'public');
        $url = Storage::url($imageName);
        $data = $request->validate([
            'category_id' => 'required|max:255',
            'sub_category_id' => 'required|max:255',
            'product_name' => 'required|max:255',
            'trade_name' => 'required|max:255',
            'finish' => 'required|max:255',
            'product_code' => 'required|max:255',
            'sort_description' => 'required|max:255',
            'description' => 'required|max:255',
            'weave' => 'required|max:255',
            'gsm' => 'required|max:255',
            'max_price' => 'required|max:255',
            'location' => 'required|max:255',
            'certificate' => 'required|max:255',
            'blend' => 'required|max:255',
            'length' => 'required|max:255',
            'width' => 'required|max:255',
            'height' => 'required|max:255',
            'image' => 'required|max:255',
            'user_id' => 'required|max:255',
        ]);
        $data['image'] = $imageName;

         $id = Product::create($data)->id;
         $count = count($request->color);
        for($i=0; $i<$count; $i++){
            $record = [
                'product_id' => $id,
                'color' => $request->color[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i]
            ];
            DB::table('product_price_details')->insert($record);
        }
        return redirect('/product/create')->withErrors('Product has been added!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('products')->where('id',$id)->get();
        $price = DB::table('product_price_details')->where('product_id',$id)->get();
        
        return view('product_details', compact('data','price'));
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
        $subcat = Subcategory::all()->sortBy('category_name');
        $data = DB::table('products')->where('id',$id)->get();
        $detail = DB::table('product_price_details')->where('product_id',$id)->get();
        //dump($data); die;
        return view('product_edit', compact('data','cat','subcat','detail'));
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
        $validated = $request->validate([
            'image' => 'mimes:jpeg,png|max:1014',
        ]);
        if($validated){
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->storeAs('uploads', $imageName, 'public');
            $url = Storage::url($imageName);
            $data = $request->validate([
                'category_id' => 'required|max:255',
                'sub_category_id' => 'required|max:255',
                'product_name' => 'required|max:255',
                'trade_name' => 'required|max:255',
                'finish' => 'required|max:255',
                'product_code' => 'required|max:255',
                'sort_description' => 'required|max:255',
                'description' => 'required|max:255',
                'weave' => 'required|max:255',
                'gsm' => 'required|max:255',
                'max_price' => 'required|max:255',
                'location' => 'required|max:255',
                'certificate' => 'required|max:255',
                'blend' => 'required|max:255',
                'length' => 'required|max:255',
                'width' => 'required|max:255',
                'height' => 'required|max:255',
            ]);
            $data['image'] = $imageName;
            Product::whereId($id)->update($data);

        }else{
            $data = $request->validate([
                'category_id' => 'required|max:255',
                'sub_category_id' => 'required|max:255',
                'product_name' => 'required|max:255',
                'trade_name' => 'required|max:255',
                'finish' => 'required|max:255',
                'product_code' => 'required|max:255',
                'sort_description' => 'required|max:255',
                'description' => 'required|max:255',
                'weave' => 'required|max:255',
                'gsm' => 'required|max:255',
                'max_price' => 'required|max:255',
                'location' => 'required|max:255',
                'certificate' => 'required|max:255',
                'blend' => 'required|max:255',
                'length' => 'required|max:255',
                'width' => 'required|max:255',
                'height' => 'required|max:255',
            ]);
            $res = Product::whereId($id)->update($data);
            
            
        }
        DB::table('product_price_details')->where('product_id',$id)->delete();

        $count = count($request->color);
        for($i=0; $i<$count; $i++){
            $record = [
                'product_id' => $id,
                'color' => $request->color[$i],
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i]
            ];
            DB::table('product_price_details')->insert($record);
        }
        return redirect('/product')->withErrors('Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        DB::table('product_price_details')->where('product_id',$id)->delete();
        return redirect('/product')->withErrors('Product has been deleted!');
    }

    public function getSubCategory(Request $request){
        $cat_id = $request->input('cat_id');
        $data = DB::table('subcategories')->where('category_id',$cat_id)->get();
        return view('product_subcategory',compact('data'));
    }

 

    public function __construct()
    {
        $this->middleware('auth');
    }
}

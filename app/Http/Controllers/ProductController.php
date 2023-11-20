<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(20);

        return view('pages.product', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->paginate(20);

        return response()->json($products);
    }
    
    public function add()
    {
        return view('pages.add-product');
    }
    
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('product');
    }
    
    public function view($id)
    {
        $product = Product::find($id);
        
        return view('pages.view-product', compact('product'));
    }
    
    public function edit($id)
    {
        $product = Product::find($id);
        
        return view('pages.edit-product', compact('product'));
    }
    
    public function store_edit(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('product');
    }
        
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect()->route('product');
    }
}

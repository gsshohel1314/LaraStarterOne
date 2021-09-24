<?php

namespace App\Http\Controllers\Backend;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required',
            'cost_price' => 'required',
            'retail_price' => 'required',
            'image' => 'required|image',
        ]);

        $product = Product::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'cost_price' => $request->cost_price,
            'retail_price' => $request->retail_price,
            'status' => $request->filled('status')
        ]);

        // upload images
        if ($request->hasFile('image')) {
            $product->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success("Product Added", "Success");
        return redirect()->route('app.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $stock = Stock::where('product_id', $product->id)->first();
        // return $stock->quantity; 
        return view('backend.product.show', compact('product', 'stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.product.form',compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:products,name,'.$product->id,
            'description' => 'required',
            'cost_price' => 'required',
            'retail_price' => 'required',
            'image' => 'nullable|image',
        ]);

        $product->update([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'cost_price' => $request->cost_price,
            'retail_price' => $request->retail_price,
            'status' => $request->filled('status')
        ]);

        // upload images
        if ($request->hasFile('image')) {
            $product->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success("Product Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        notify()->success("Product Deleted", "Success");
        return back();
    }
}

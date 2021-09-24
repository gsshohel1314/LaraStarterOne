<?php

namespace App\Http\Controllers\Backend;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManageStock;

class StockController extends Controller
{
    public function index()
    {
       
    }

    
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('backend.stock.form',compact('categories'));
    }

    public function findProductName(Request $request){

		
	    //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=Product::select('name','id')->where('category_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	}


	// public function findPrice(Request $request){
	
	// 	//it will get price if its id match with product id
	// 	$p=Product::select('price')->where('id',$request->id)->first();
		
    // 	return response()->json($p);
	// }


    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|unique:stocks',
        ]);

        // dd($request->all());
        $category_id =  $request->category_id;
        $product_id =  $request->product_id;
        $quantity =  $request->quantity;

        for($i=0; $i < count($category_id); $i++){
            $datasave= [
                'category_id' => $category_id[$i],
                'product_id' => $product_id[$i],
                'quantity' => $quantity[$i],
            ];
            Stock::insert($datasave);
        }

        notify()->success("Product added in stock", "Success");
        return back();
    }

    public function show(Stock $stock)
    {
        //
    }

    public function edit(Stock $stock)
    {
        //
    }

    public function update(Request $request, Stock $stock)
    {
        //
    }

    public function destroy(Stock $stock)
    {
        //
    }

    public function manageStockIndex(){
        $products = Product::all();
        return view('backend.stock.manageStockForm', compact('products'));
    }

    public function findProductQuantity(Request $request){
	
		//it will get price if its id match with product id
		$quantity=Stock::select('quantity')->where('product_id',$request->id)->first();
		
    	return response()->json($quantity);
	}

    public function manageStockStore(Request $request){
        // dd($request->all());
        // dd($request->product_id);
        if($request->quantity && $request->quantity > 0){
            ManageStock::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'status' => $request->status
            ]);

            $stockQuantity = Stock::where('product_id', $request->product_id)->first();
            if($request->status == ManageStock::STOCK_IN){
                // stock in
                $stockQuantity->quantity = $stockQuantity->quantity + $request->quantity;
            }else{
                // stock out
                $stockQuantity->quantity = $stockQuantity->quantity - $request->quantity;
            }
            $stockQuantity->save();

            notify()->success("Product stock updated", "Success");
            return back();
        }else{
            notify()->success("Update quantity is less than 0", "Error");
            return back();
        }
    }


    // Stock in out history
    public function stockHistoryIndex(){
        $stockHistory = ManageStock::orderBy('created_at', 'DESC')->get();
        // return $stockHistory;
        return view('backend.stock.manageStockHistory', compact('stockHistory'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at','DESC')->get();
        return view('pages.index',compact('products'));
    }
    public function create(){
        return view('pages.create');
    }
    public function store(Request $request){
        $rules = [
            'product_id' => 'required|min:4',
            'name' => 'required|min:5',
            'price' => 'required|numeric'
        ];
        if($request->image != ""){
            $rules['image'] = 'image';
        }
       $validator = Validator::make($request->all(),$rules);
       if($validator->fails()){
        return redirect()->route('products.create')->withInput()->withErrors($validator);
       }
       //Database insert
       $product = new Product();
       $product->product_id = $request->product_id;
       $product->name = $request->name;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->stock = $request->stock;
       $product->save();

       if($request->image != ""){
        //image store
       $image = $request->image;
       $extension = $image->getClientOriginalExtension();
       $imageName = time().'.'.$extension;

       //Save imagees in public directory
       $image->move(public_path('uploads/products'), $imageName);

       $product->image = $imageName;
       $product->save();
       }



       return redirect()->route('products.index')->with('succes','Product added successfully.');

    }
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('pages.edit',compact('product')); 
    }
    public function update($id,Request $request){
        $product = Product::findOrFail($id);
        $rules = [
            'product_id' => 'required|min:4',
            'name' => 'required|min:5',
            'price' => 'required|numeric'
        ];
        if($request->image != ""){
            $rules['image'] = 'image';
        }
       $validator = Validator::make($request->all(),$rules);
       if($validator->fails()){
        return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
       }
       
       //update product
       $product->product_id = $request->product_id;
       $product->name = $request->name;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->stock = $request->stock;
       $product->save();

       if($request->image != ""){
        //for deleting old image
        File::delete(public_path('uploads/products/'.$product->image));
        //image store
       $image = $request->image;
       $extension = $image->getClientOriginalExtension();
       $imageName = time().'.'.$extension;

       //Save imagees in public directory
       $image->move(public_path('uploads/products'), $imageName);

       $product->image = $imageName;
       $product->save();
       }



       return redirect()->route('products.index')->with('success','Product updated successfully.');

    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        //delete image
        File::delete(public_path('uploads/products/'.$product->image));
        //delete product from db
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        return view('products.index', [
            'products'=>Product::get()
        ]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        // dd($request->all());
        //validate data 
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required | mimes: jpeg,jpg,png,gif | max: 10000'
        ]);

        //image store
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product Created !!!!!');

    }

    public function edit($id){
        // dd($id);
        $product = Product::where('id', $id)->first();

        return view('products/edit', ['product' => $product]);
    }

    public function update(Request $request, $id){
        //validate data 
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max: 10000'
        ]);

        $product = Product::where('id', $id)->first();

        if (isset($request->image)) {
            // Delete old image if it exists
            if ($product->image) {
                $oldImagePath = public_path('products') . '/' . $product->image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
    
            // Image upload
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product Updated !!!!!');
    }

    public function destroy($id){

        $product = Product::find($id);
        // Delete the associated image if it exists
        if ($product->image) {
            $imagePath = public_path('products') . '/' . $product->image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $product->delete();
        return back()->withSuccess('Product Deleted !!!!!');
    }

    public function show($id){
        $product = Product::where('id',$id)->first();
        return view('products.show', ['product' => $product]);

    }


}

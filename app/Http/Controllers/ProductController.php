<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:5|max:50',
            'description' => 'required|min:20',
            'product_price' => 'required|numeric',
            'product_image' => 'sometimes|mimes:jpg,jpeg,png,wepb,bmp',
        ]);

        // change image name
        $image_extension = $request->product_image->extension();
        $image_name = time() . '.' . $image_extension;

        // store image in storage folder
        Storage::put("/public/product_images/$image_name", file_get_contents($request->product_image));

        // create product
        Product::create([
            'product_name' => $request['product_name'],
            'description' => $request['description'],
            'price' => $request['product_price'],
            'image' => $image_name,
            'category_id' => $request['category_id'],
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|min:5|max:50',
            'description' => 'required|min:20',
            'product_price' => 'required|numeric',
            'product_image' => 'sometimes|mimes:jpg,jpeg,png,wepb,bmp',
        ]);

        $product = Product::find($id);
        $image_name = $product->image;

        if ($request->hasFile('product_image')) {
            // change image name
            $image_extension = $request->product_image->extension();
            $image_name = time() . '.' . $image_extension;

            if (Storage::exists("public/product_images/$product->image")) {
                Storage::delete("public/product_images/$product->image");
            }
            Storage::put("/public/product_images/$image_name", file_get_contents($request->product_image));
        }

        // show product
        Product::whereId($id)->update([
            'product_name' => $request['product_name'],
            'description' => $request['description'],
            'price' => $request['product_price'],
            'image' => $image_name,
            'category_id' => $request['category_id'],
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        Storage::delete("public/product_images/$product->image");
        $product->delete();
        return redirect()->route('products.index');
    }


}

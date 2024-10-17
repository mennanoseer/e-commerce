<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:5|max:25|unique:categories,category_name',
            'category_image' => 'required|mimes:jpg,jpeg,png,webp,bmp',
        ]);

        // change image name
        $image_extension = $request->category_image->extension();
        $image_name = time() . '.' . $image_extension;

        // store image in storage folder
        Storage::put("/public/category_images/$image_name", file_get_contents($request->category_image));

        // create category
        Category::create([
            'category_name' => $request['category_name'],
            'image' => $image_name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:5|max:25|unique:categories,category_name,' . $id,
            'category_image' => 'sometimes|mimes:jpg,jpeg,png,webp,bmp',
        ]);

        $category = Category::findOrFail($id);
        $image_name = $category->image;

        if ($request->hasFile('category_image')) {
            // change image name
            $image_extension = $request->category_image->extension();
            $image_name = time() . '.' . $image_extension;

            // store image in storage folder
            Storage::put("/public/category_images/$image_name", file_get_contents($request->category_image));

            // Delete old image
            if ($category->image) {
                Storage::delete("/public/category_images/{$category->image}");
            }
        }

        $category->update([
            'category_name' => $request['category_name'],
            'image' => $image_name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::delete("/public/category_images/{$category->image}");
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}

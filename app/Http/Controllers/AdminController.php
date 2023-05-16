<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }

    public function add_category()
    {
        $category = category::all();
        return view('admin.add_category', compact('category'));
    }

    public function new_category(Request $request)
    {
        $category = new Category;

        $category->category_name = $request->category;
        $category->save();

        return redirect()->back()->with('message', 'Category added successfully');

    }

    public function delete_category($id)
    {
        $category = category::find($id);
        $category->delete();

        return redirect()->back()->with('message', 'Category deleted successfully');

    }

    public function add_product()
    {
        $category = category::all();
        return view('admin.add_product', compact('category'));
    }

    public function create_product(Request $request)
    {
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->product_price;
        $product->discount = $request->dis_price;
        $product->quantity = $request->product_quantity;
        $product->category = $request->product_category;

        $image = $request->image;

        $imageName = time().'.'. $image->getClientOriginalExtension();
        $request->image->move('Product Images', $imageName);
        $product->image = $imageName;

        $product->save();

        return redirect()->back()->with('message','Product added successfully');


    }

    public function all_products()
    {
        $product = product::all();
        return view('admin.all_products', compact('product'));
    }

    public function edit_product()
    {
        return view('admin.edit_product');
    }
}

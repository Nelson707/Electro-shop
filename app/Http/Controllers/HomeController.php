<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $role = Auth::user()->role;
        if ($role == '1')
        {
            $total_products = product::all()->count();
            $total_categories = category::all()->count();
            $total_users = user::all()->count();
            return view('admin.dashboard', compact('total_products','total_categories','total_users'));
        }
        else
        {
            $product = product::all();
            $category = category::all();
            return view('home.index', compact('product','category'));
        }
    }

    public function index()
    {
        $product = product::all();
        $category = category::all();
        return view('home.index', compact('product','category'));
    }

    public function product_details($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('home.product_details', compact('product','category'));
    }
}

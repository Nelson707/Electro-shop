<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.index', compact('product','category','cart','total_cart'));
    }

    public function product_details($id)
    {
        $product = product::find($id);
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.product_details', compact('product','category','cart','total_cart'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id())
        {
            $user = Auth::user();
            $product = product::find($id);

            $cart = new cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;
            if ($product->discount != null)
            {
                $cart->price = $product->discount * $request->quantity;
            }
            else
            {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->quantity = $request->quantity;
            $cart->image = $product->image;

            $cart->product_id = $product->id;

            $cart->save();

            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id())
        {
            $id = Auth::user()->id;
            $cart = cart::where('user_id','=',$id)->get();
            $total_cart = cart::all()->count();
            $category = category::all();
            return view('home.view_cart', compact('category','cart','total_cart'));
        }
        else{
            return redirect('login');
        }

    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();

        return redirect()->back()->with('message', 'Product removed from cart successfully');
    }
}

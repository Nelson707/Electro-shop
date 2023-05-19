<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

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
            $cart = cart::all();
            $total_cart = cart::all()->count();
            return view('home.index', compact('product','category','cart','total_cart'));
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
            $user_id = $user->id;
            $product = product::find($id);

            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();

            if ($product_exist_id)
            {
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if ($product->discount != null)
                {
                    $cart->price = $product->discount * $cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();
                return redirect()->back()->with('message', 'Product added to cart successfully');
            }
            else
            {
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

                return redirect()->back()->with('message', 'Product added to cart successfully');
            }

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

    public function cash_order()
    {
        $user = Auth::user();
        $userId = $user->id;

        $data = cart::where('user_id','=',$userId)->get();

        foreach ($data as $data)
        {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->user_id = $data->user_id;
            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'Processing...';

            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message', 'We have received your order! Instructions will be sent shortly');
    }

    public function stripe($totalPrice)
    {
        $total_cart = cart::all()->count();
        $cart = cart::all();
        return view('home.stripe', compact('totalPrice','total_cart','cart'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $totalPrice / 1,

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Test payment from Electro shop"
        ]);

        $user = Auth::user();
        $userId = $user->id;

        $data = cart::where('user_id','=',$userId)->get();

        foreach ($data as $data)
        {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->user_id = $data->user_id;
            $order->payment_status = 'Paid with card';
            $order->delivery_status = 'Processing...';

            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');
        return back();
    }

    public function search_home(Request $request)
    {
        $products = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('category','LIKE',"%$searchText%")->orWhere('tag','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('home.index', compact('products','category','cart','total_cart','product'));
    }

    public function show_order()
    {
        if (Auth::id())
        {
            $cart = cart::all();
            $total_cart = cart::all()->count();
            $user = Auth::user();
            $userId = $user->id;
            $order = order::where('user_id','=',$userId)->get();
            return view('home.order', compact('order','cart','total_cart'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
//        $order->payment_status = 'Cancelled';
//        $order->delivery_status = 'Cancelled';

        $order->delete();

        return redirect()->back()->with('message','Order cancelled successfully');
    }

    public function all_laptops()
    {
        $product = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.laptops', compact('product','category','cart','total_cart'));
    }

    public function search_laptops(Request $request)
    {
        $products = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('home.laptops', compact('products','category','cart','total_cart','product'));
    }

    public function all_desktops()
    {
        $product = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.desktops', compact('product','category','cart','total_cart'));
    }

    public function search_desktops(Request $request)
    {
        $products = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('home.desktops', compact('products','category','cart','total_cart','product'));
    }

    public function all_smartphones()
    {
        $product = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.smartphones', compact('product','category','cart','total_cart'));
    }

    public function search_smartphones(Request $request)
    {
        $products = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('home.smartphones', compact('products','category','cart','total_cart','product'));
    }

    public function all_cameras()
    {
        $product = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.cameras', compact('product','category','cart','total_cart'));
    }

    public function search_cameras(Request $request)
    {
        $products = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('home.cameras', compact('products','category','cart','total_cart','product'));
    }

    public function all_accessories()
    {
        $product = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        return view('home.accessories', compact('product','category','cart','total_cart'));
    }

    public function search_accessories(Request $request)
    {
        $products = product::all();
        $category = category::all();
        $cart = cart::all();
        $total_cart = cart::all()->count();
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('home.accessories', compact('products','category','cart','total_cart','product'));
    }



}

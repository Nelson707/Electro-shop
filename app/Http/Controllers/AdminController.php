<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
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
        $product->tag = $request->product_tag;

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

    public function edit_product($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('admin.edit_product', compact('product','category'));
    }

    public function update_product(Request $request, $id)
    {
        $product = product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->product_price;
        $product->discount = $request->dis_price;
        $product->quantity = $request->product_quantity;
        $product->category = $request->product_category;
        $product->tag = $request->product_tag;

        $image = $request->image;

        if ($image)
        {
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('Product Images', $imageName);

            $product->image = $imageName;
        }


        $product->save();

        return redirect()->back()->with('message','Product updated successfully');
    }

    public function delete_product($id)
    {
        $product = product::find($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function all_users()
    {
        $user = user::all();
        return view('admin.users', compact('user'));
    }

    public function delete_user($id)
    {
        $user = user::find($id);
        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully');
    }

    public function orders()
    {
        $order = order::all();
        return view('admin.orders', compact('order'));
    }

    public function delivered($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function searchProduct(Request $request)
    {
        $searchText = $request->search;
        $product = product::where('title','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->orWhere('category','LIKE',"%$searchText%")->orWhere('tag','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('admin.all_products', compact('product'));
    }

    public function searchOrders(Request $request)
    {
        $searchText = $request->search;
        $order = order::where('name','LIKE',"%$searchText%")->orWhere('email','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->orWhere('price','LIKE',"%$searchText%")->get();

        return view('admin.orders', compact('order'));
    }

    public function send_email($id)
    {
        $order = order::find($id);
        return view('admin.email_info', compact('order'));
    }

    public function send_user_email(Request $request, $id)
    {
        $order = order::find($id);
        $details = [
            'greeting' => $request->greeting,
            'firstLine' => $request->firstLine,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastLine' => $request->lastLine,
        ];

        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back()->with('message','Email sent successfully');
    }

}

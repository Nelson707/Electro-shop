<?php

namespace App\Http\Controllers;

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
        return view('admin.add_category');
    }

    public function add_product()
    {
        return view('admin.add_product');
    }

    public function all_products()
    {
        return view('admin.all_products');
    }
}

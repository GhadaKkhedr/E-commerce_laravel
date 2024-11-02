<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->get();
        //  echo json_encode($users);
        $category = DB::table('category')->get();
        $products = DB::table('product_view')->get();
        return view('home', ['users' => $users, 'products' => $products, 'categories' => $category]);
    }
}

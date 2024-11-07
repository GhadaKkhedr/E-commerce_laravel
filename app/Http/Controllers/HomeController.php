<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        if (Auth::user()->identity === 2) //admin
        {
            $users = DB::table('users')->get();
            //  echo json_encode($users);
            $category = DB::table('category')->get();
            $products = DB::table('product_view')->get();
            return view('home', ['users' => $users, 'AllProducts' => $products, 'categories' => $category]);
        } elseif (Auth::user()->identity === 1) { // customer
            //$controller = new ProductController();
            //return $controller->filter($request);
            return redirect()->route('search');
        } else // seller
        {
            // echo "in Home controller" . Auth::user()->identity;
            $userID = Auth::user()->id;
            $category = DB::table('category')->get();
            $products = DB::table('product_view')->get()->where('SellerID', '=', $userID);
            // dd($products);
            return view('home', ['sellerProducts' => $products, 'categories' => $category]);
        }
    }
}

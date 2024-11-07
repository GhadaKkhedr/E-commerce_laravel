<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Exception;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


use App\Models\product_view;
use App\Models\category;
use App\Models\product;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\throwException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $count = 0;
    public function index(string $prdID, Request $request)
    {
        $cart = new cart();

        //  $cart = Session->get('cart'); // Retrieve the cart or initialize it as an empty array
        $cart->productID = $prdID;
        $product = product::find($prdID);
        // dd($product->id);
        $pdctImg = $product->pImage;
        $pName = $product->name;
        $cart->prdtImg = $pdctImg;
        $cart->prdtName = $pName;
        $cart->CustomerID = Auth::user()->id;
        $cart->price = $product->price;
        $cart->CountOfProductID = $request->input('count' . $prdID);
        try {
            // dd($cart);
            //  $cart->saveOrFail();
            //  $this->show( $request->input('count' . $prdID));


            //Session::push('cart.items[$this->count-1]', $cart);
            // return response()->json(Session::all());
            //  dd(Session::get('cart'));
        } catch (Exception $e) {
            return redirect()->back()->with("error", "item couldn't be added!");
        }
    }
    public function __construct()
    {
        $this->count++;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $prdID, Request $request)
    {
        $cart = cart::where('CustomerID', '=', Auth::user()->id)->get()->where('Paid', '=', '0');
        $AllProducts = product_view::get();
        $categories = category::get();

        try {
            // dd($request[1]);
            if ($request->has('quantity' . $prdID)) {

                $quantity = $request->input('quantity' . $prdID);
                $this->UpdateProduct($prdID, $quantity);
            } else
              if ($request->has('count' . $prdID))
                $this->AddProduct($prdID, $request->input('count' . $prdID));

            else
                dd('quantity' . $prdID);
            $cart = cart::where('CustomerID', '=', Auth::user()->id)->get()->where('Paid', '=', '0');
            //dd($cart, $AllProducts);
            return view('home', ['cart' => $cart, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
        } catch (Exception $exception) {
            return view('home', ['cart' => $cart, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
        }
    }
    protected function AddProduct(string $id, string $numOfItems)
    {
        try {
            $cart = new cart();
            $cart->productID = $id;
            $cart->CustomerID = Auth::user()->id;


            if (!$this->Exists($cart, $numOfItems)) // new item added
            {
                $product = product::find($id);
                $pdctImg = $product->pImage;
                $pName = $product->name;
                $cart->prdtImg = $pdctImg;
                $cart->prdtName = $pName;
                $cart->price = $product->price;
                $cart->CountOfProductID = $numOfItems;
                $cart->save();
            }
        } catch (Exception $exception) {
        }
    }
    private function Exists(cart $cart, string $numOfItems)
    {
        $exists = DB::table('cart')
            ->where('productID', $cart->productID)
            ->where('CustomerID', $cart->CustomerID)
            ->first();
        DB::table('cart')
            ->where('productID', $cart->productID)
            ->where('CustomerID', $cart->CustomerID)
            ->first();
        if ($exists) {
            $old = $exists->CountOfProductID;
            DB::table('cart')
                ->where('productID', $cart->productID)
                ->where('CustomerID', $cart->CustomerID)
                ->update(['CountOfProductID' => ($numOfItems + $old)]); // replace `$newQuantity` with the desired value

            // $exists->save();
            return true;
        } else
            return false;
    }
    private function UpdateProduct(string $prdID, string $numOfItems)
    {
        DB::table('cart')
            ->where('productID', $prdID)
            ->where('CustomerID', Auth::user()->id)
            ->update(['CountOfProductID' => $numOfItems]); // replace `$newQuantity` with the desired value
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = cart::where('CustomerID', '=', Auth::user()->id)->get()->where('Paid', '=', '0');
        $AllProducts = product_view::get();
        $categories = category::get();
        try {
            $cartItem = cart::where('productID', '=', $id)
                ->where('CustomerID', '=', Auth::user()->id)
                ->get()
                ->first();

            $cartItem->delete();
            $cart = cart::where('CustomerID', '=', Auth::user()->id)->get();
            return view('home', ['cart' => $cart, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
        } catch (Exception $e) {
            return view('home', ['cart' => $cart, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
        }
    }
}

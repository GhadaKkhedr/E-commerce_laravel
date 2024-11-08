<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use App\Models\product_view;
use App\Models\cart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //dd($request->all());
        try {
            // dd($request->input('selectedCategory'));
            $validatedData = $this->validate($request,  [
                'pName' => ['required', 'string'],
                'pDesc' => ['required', 'string'],
                'selectedCategory' => ['required', 'string'],
                'pImage' => ['required',  'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'pPrice' => ['required', 'numeric'],
                'pQuantity' => ['required', 'numeric'],
            ]);
            // dd($validatedData);
            $product = new product();
            $product->name = $request->input('pName');
            $product->description = $request->input('pDesc');
            $category = Category::where('name', '=', $request->input('selectedCategory'))->get(['id'])->first();
            //   dd($request->pImage);
            $product->categoryID = $category->id;

            $imageName = time() . '.' . $request->pImage->extension();
            //strtolower(pathinfo($request->pImage, PATHINFO_EXTENSION)); // substr(strrchr($file_name, '.'), 1);
            //  dd($imageName);
            $request->pImage->move(public_path('images/prdImgs/'), $imageName);

            $product->pImage = 'images/prdImgs/' . $imageName; //$request->input('pImage');

            $product->price = (int)$request->input('pPrice');
            $product->sellerAddedIt = Auth::user()->id;
            $product->quantityAvailable = (int)$request->input('pQuantity');
            //  dd($product);
            $product->save();
            return redirect('home')->with('success', 'product inserted successfully!');
        } catch (ValidationException  $e) {
            return redirect('home')->with('error', 'product not inserted');
        }
    }

    /**
     * Display the specified resource.
     */
    public function filter(Request $request)
    {

        //  echo ($request->has("keyword") ? "true" : "false");
        try {
            $keyword = $request->input('keyword', '');
            $categories = category::get();
            $filteredProducts = collect();
            if ($keyword) {
                //echo ("in filter" . $keyword);
                // $filteredProducts = product_view::whereAny(['productName', 'description', 'CategoryName'], 'LIKE', '%$keyword%')->get();
                $filteredProducts = product_view::where('productName', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->orWhere('CategoryName', 'LIKE', "%$keyword%")
                    ->get();
                if (!Auth::user()->identity) { //seller
                    $filteredProducts = product_view::where('sellerName', '=', Auth::user()->name)
                        ->where('productName', 'LIKE', "%$keyword%")
                        ->orWhere('description', 'LIKE', "%$keyword%")
                        ->orWhere('CategoryName', 'LIKE', "%$keyword%")
                        ->get();
                    //dd($filteredProducts);
                }
            }

            $AllProducts = collect();
            //dd($filteredProducts);
            if (empty($keyword) || (Auth::user()->identity === 2)) {
                $AllProducts = product_view::get();
            }
            $cart = "";
            $users = "";
            if (Auth::user()->identity === 1) {
                $cart = cart::where('CustomerID', '=', Auth::user()->id)
                    ->where('Paid', '=', '0')
                    ->get();
            }
            if (Auth::user()->identity === 2) //admin
                $users = User::get();
            if (!$request->has('keyword')) //first load
            {
                if (Auth::user()->identity === 1)
                    return view('home', ['cart' => $cart, 'filteredProducts' => $filteredProducts, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
                else
                    return view('home', ['AllProducts' => $AllProducts, 'AllCategories' => $categories]);
            } else {
                if (!Auth::user()->identity) //seller
                    return view('home', ['sellerProducts' => $filteredProducts, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
                else
                if (Auth::user()->identity === 1) //customer
                    return view('home', ['cart' => $cart, 'filteredProducts' => $filteredProducts, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);

                else //admin
                    return view('home', ['users' => $users, 'filteredProducts' => $filteredProducts, 'AllProducts' => $AllProducts, 'AllCategories' => $categories]);
            }
        } catch (Exception $exception) {
            return view('home')->with(['error' => $exception]);
        }
    }
    public function filterByCategory(Request $request)
    {


        try {
            $keyword = $request->input('keywordCat', '');
            $filteredProducts = collect();
            if ($keyword) {
                //       echo ("in filter" . $keyword);
                // $filteredProducts = product_view::whereAny(['productName', 'description', 'CategoryName'], 'LIKE', '%$keyword%')->get();
                $filteredProducts = product_view::where('CategoryName', '=', "$keyword")
                    ->get();
            }
            //dd($filteredProducts);

            //  dd($AllProducts, $filteredProducts, $categories);
            $categories = category::get();
            return view('home', ['filteredProducts' => $filteredProducts, 'AllCategories' => $categories]);
        } catch (Exception $exception) {
            return view('home')->with(['error' => $exception]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        // dd($request->all());
        try {

            $product = product::find($id);

            //get updated data
            $data = 'updatep' . $product->id;
            $data2 = 'crdUpdateProduct' . $product->id;
            $dataSent = "";
            if ($request->has($data))
                $dataSent =  $request->input($data); // from home page (adminstrator)
            else
                $dataSent =  $request->input($data2); //from seller page
            //  dd($dataSent);
            $dataSentArray =  explode(";", $dataSent);


            // dd($request->all()['update1']);
            $product->name = $dataSentArray[0];
            $product->description = $dataSentArray[1];

            $product->price = $dataSentArray[2];
            $product->quantityAvailable = $dataSentArray[3];

            // $category = Category::where('name', '=', $request->input('pCat' . $id))->get(['id'])->first();
            // dd($request->input('pCatp' . $id));
            //  $product->CategoryName = $request->input('pCat' . $id);
            if ($request->has($data)) {
                $categoryName = $dataSentArray[4];
                $category = Category::where('name', '=', $categoryName)->get(['id'])->first();
                $product->categoryID = $category->id;
            }
            // dd($product);
            $product->save();
            return redirect('home')->with('success', 'product updated!');
        } catch (Exception $exception) {
            return redirect('home')->with('error', 'product not updated!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = product::findOrFail($id);
            $product->delete();
            return redirect('home')->with('success', 'product deleted!');
        } catch (Exception $e) {
            return redirect('home')->with('error', 'product not deleted!');
        }
    }
}

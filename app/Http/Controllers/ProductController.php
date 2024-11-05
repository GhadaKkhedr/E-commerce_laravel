<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
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
    public function show(product $product)
    {
        //
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

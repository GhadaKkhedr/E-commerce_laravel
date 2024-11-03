<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\category;

class CategoryController extends Controller
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
    public function create($name)
    {

        DB::table('category')->insert(['name' =>  $name]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo 'in store method';
        $this->validate($request,  [
            'categoryName' => ['required', 'string'],
        ]);

        $category = new Category();
        $category->name = $request->input('categoryName');
        $category->save();
        return redirect('home')->with('success', 'category inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {


        //$this->validate($request->input('categoryName'), ['string']);
        $category = Category::find($id);

        $name = 'update' . $category->id;
        // dd($request->all()['update1']);
        $category->name = $request->input($name);

        $category->save();
        return redirect('home')->with('success', 'Category updated');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {}
    //


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('home')->with('success', 'category deleted');

        //
    }
}

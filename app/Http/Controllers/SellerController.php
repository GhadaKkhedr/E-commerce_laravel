<?php

namespace App\Http\Controllers;

use app\Models\User;


use App\Models\seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}
    public function isSeller($id)
    {
        $identity = User::find($id)->identity();
        return $identity === 0 ? '1' : '0';
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
    public function show(User $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $seller)
    {
        //
    }
}

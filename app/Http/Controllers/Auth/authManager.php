<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
//use function Laravel\Prompts\alert;

class authManager extends Controller
{
    public function login_get()
    {
        return view("UserForms.Login");
    }
    public function login(Request $request)
    {
        // return view('UserForms\Login');
        $request->validate(
            [
                "email" => "required|email",
                "password" => "required",
                "username" => "required",
            ]
        );
        $credentials = $request->only("username", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home"));
        } else {
            return "invalid username or password";
        }
        // $user = User::where("email", $request->email)->first();*/
    }
    public function register_get()
    {
        return view('UserForms\Register');
    }
    public function register(Request $request)
    {

        //return view('UserForms\Register');
        $validatedData = $request->validate(
            [
                "email" => "required|email|unique:users",
                "password" => "required",
                "userName" => "required",
                "identity" => "required",
            ]
        );

        // return $validatedData;
        $user = authManager::store($validatedData);
        if ($user) {

            return redirect()->intended(route("home"));
        } else {
            return redirect("Register")->withErrors(["registration failed!"]);
        }
    }
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
    public function store(array $request)
    {

        $user = User::create([
            "Fname" => $request['Fname'],
            "email" => $request['email'],
            //  "password" => bcrypt($request->password),
            "password" => Hash::make($request['password']),
            "username" => $request['username'],
            "identity" => $request['identity'],
        ]);
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register_get()
    {
        return view('UserForms\Register');
    }
    public function register(Request $request)
    {
        $validator = validator($request->all()) ?? [];

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $identity = json_encode($request->input('identity')) ?? 'null';

        $_identity['identity'] = $identity;

        try {
            $user = $this->create(array_merge($request->all(), $_identity));
            if ($user) {
                // echo json_encode($user);
                session("username", $user->username);
                return redirect()->route('login');
            }
        } catch (QueryException $e) {

            return back()->withErrors('email already exists , please login');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'FName' => ['required'],
            'userName' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'Password' => ['required', 'string'],
            'identity' => ['required', 'boolean'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //echo json_encode($data);
        return User::create([
            'Fname' => $data['FName'],
            'email' => $data['Email'],
            'userName' => $data['userName'],
            'password' => Hash::make($data['Password']),
            'identity' => $data['identity'] === '1' ? true : false,
        ]);
    }
}

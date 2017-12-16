<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; //moi them vao
use Illuminate\Http\Request; //moi them vao
//use Illuminate\Support\Facades\Hash; //moi them vao de? Bcrypt
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers; //Mac dinh. la` turn on



    public function authenticate(Request $request)
    {
        $id=$request->input('email');
        //$password=Hash::make($request->input('password'));
        //$password=Bcrypt($request->input('password'));
        $password=$request->input('password');

        if (Auth::attempt(['sv_ma' => $id, 'password' => $password],true)) {
            // Authentication passed...
            Auth::login(Auth::user(), true);
            return redirect()->intended('home');
        }else
            return redirect()->back();
            
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('login');
    }

    

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
}

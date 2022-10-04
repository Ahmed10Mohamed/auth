<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function login(Request $request)
    {
        $validateData = $request->validate(
        [
            'phone'=>'required',
            'password'=>'required'
        ],
        $messages = [
            'phone.required' => 'Please Enter User Name',
            'password.required' => 'Please Enter Password'
        ]);

        $user = Admin::where('phone', '=', $request->phone)->first();
        if($user === NULL)
        {
            return redirect()->back()->withErrors("Wrong Login Information");
        }
        else if(!Hash::check($request->password, $user->password))
        {
            return redirect()->back()->withErrors("Wrong Login Information");
        }

        Auth::guard('admin')->login($user, true);

        if(Auth::guard('admin')->user()->type == 1){
            // store
            return redirect()->route('store.index');

        }elseif(Auth::guard('admin')->user()->type == 2){
            // admin
            return redirect()->route('admin.index');
        }else{
            // user
            return redirect()->route('user.index');
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        // $request->session()->invalidate();
        return redirect('/admin/login');
    }
}

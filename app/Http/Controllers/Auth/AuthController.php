<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /** @var string Redirect path after login */
    protected $redirectPath = '/';
    
    /** @var string Redirect path after failed login */
    protected $loginPath = '/login';


    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if ($newUser) {
            Mail::send('emails.registration', compact('newUser'), function ($m) use ($newUser) {
                $m->from('kratenklaar@dekroon.xyz', 'Krat en Klaar');

                $m->to($newUser->email, $newUser->name)->subject('Registratie gelukt!');
            });
        }

        return $newUser;
    }

    /**
     * Display the login page.
     *
     * @return view
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Display the registration page.
     *
     * @return view
     */
    public function getRegister()
    {
        return view('auth.register');
    }
}

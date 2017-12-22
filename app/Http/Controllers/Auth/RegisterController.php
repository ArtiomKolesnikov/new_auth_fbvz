<?php

namespace App\Http\Controllers\Auth;

use App\EmailLogin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        $this->validate($request, ['email' => 'required|exists:users']);

        $emailLogin = EmailLogin::createForEmail($data['email']);

        $url = route('auth.email-authenticate', [
            'token' => $emailLogin->token
        ]);

        Mail::send('auth.emails.email-login', ['url' => $url], function ($m) use ($data) {
            $m->from('noreply@myapp.com', 'MyApp');
            $m->to($data['email'])->subject('MyApp login');
        });

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
        ]);
    }

}

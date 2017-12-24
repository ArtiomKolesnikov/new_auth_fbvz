<?php

namespace App\Http\Controllers\Auth;

use App\EmailLogin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

               $this->middleware('guest')->except('logout');


    }

    public function logined(Request $request)
    {
        if($request->phone)
        {
            $this->validate($request,[
                'phone' => 'required|regex:/(\+7)[0-9]{9}/'
            ]);
            dd($request->phone);
        }elseif ($request->email)
        {
            $emailLogin = EmailLogin::where('email', $request->email)->firstOrFail();
            if($emailLogin)
            {
                $emailLogin = EmailLogin::updateForEmail($emailLogin->email);
                $url = route('auth.email-authenticate', [
                    'token' => $emailLogin->token
                ]);
                $data = $request->all();
                Mail::send('auth.emails.email-login', ['url' => $url], function ($m) use ($data) {
                    $m->from('noreply@myapp.com', 'MyApp');
                    $m->to($data['email'])->subject('MyApp login');
                });
//               $this->authenticateEmail($emailLogin->token);
//               $this->middleware('guest')->except('logout');
                return redirect()->route('home');
            }
        }
//        return redirect('/');
    }

    public function authenticateEmail($token)
    {
        $emailLogin = EmailLogin::validFromToken($token);
//        dd($emailLogin->user);

        Auth::login($emailLogin->user);

        return redirect()->route('home');
    }
}

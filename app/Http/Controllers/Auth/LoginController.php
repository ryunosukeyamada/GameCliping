<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use App\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // ログアウト後の処理
    protected function loggedOut(Request $request){
        return redirect('/home');
    }
    // ログイン複数回失敗によるディレイ
    protected $decayMinutes = 3;

    // GuestLogin
    public function guestLogin() {
        $email = 'guest1@guest.com';
        $password = 'GuestPassword123';
        if(Auth::attempt(['email' => $email,'password' => $password])){
            return redirect()->route('clips.index');
        }
        return back();
    }

    // GoogleLogin
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request) {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email',$googleUser->email)->first();
        if($user){
            $this->guard()->login($user,true);
            return $this->sendLoginResponse($request);
        }
        return redirect()->route('register.google',['token' => $googleUser->token]);
    }
}

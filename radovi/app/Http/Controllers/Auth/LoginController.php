<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    //funkcija za login korisnika koja pri loginu salje korisnike na odredenu stranicu ovisno o ulozi
    public function login(Request $request):RedirectResponse{

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attemptWhen($credentials)) {
            $request->session()->regenerate();
            $user = User::where('email', $request->email)->first();

            if($user->getRole()=='admin')
            {
                return redirect()->route('admin');
            }
            else if($user->getRole()=='nastavnik')
            {
                return redirect()->route('nastavnik');
            }
            
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

   /**
   * Handle an authentication attempt.
   */
  public function authenticate(Request $request)
  {
    // dd($request->all());
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    // dd($request->all());
      if (Auth::attempt($credentials)) {
          $request->session()->regenerate();

          return redirect()->intended('/');
      }

      return back()->withErrors([
          'email' => 'The provided credentials do not match our records.',
      ])->onlyInput('email');
  }
}

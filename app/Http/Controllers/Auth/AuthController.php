<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function postRegister() {
    Auth::login(Auth::user(), $rememberMe = true); //Automatically "Remember Me" on registration

    return view('auth.post_register');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function postVerify() {
    return view('auth.post_verify');
  }


}

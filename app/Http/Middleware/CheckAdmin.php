<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Auth;

class CheckAdmin {

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    if (!Auth::check() || !Auth::user()->is_admin) {
      return redirect(route('index'))->with('status', 'You must be an admin user to access that page.');
    }

    return $next($request);
  }

}

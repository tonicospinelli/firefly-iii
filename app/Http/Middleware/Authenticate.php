<?php
declare(strict_types = 1);

namespace FireflyIII\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

/**
 * Class Authenticate
 *
 * @package FireflyIII\Http\Middleware
 */
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        } else {
            if (intval(Auth::user()->blocked) === 1) {
                Auth::guard($guard)->logout();
                Session::flash('logoutMessage', trans('firefly.block_account_logout'));

                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}

<?php namespace App\Http\Middleware;

use Closure;
use Config;
use Cookie;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }
        //if (!$request->ajax() && $request->getMethod() == 'GET') {
            // apply a cookie for ajax requests
            //Cookie::queue('XSRF-TOKEN', csrf_token(), Config::get('session.lifetime'));
        //}

        return $next($request);
    }

}

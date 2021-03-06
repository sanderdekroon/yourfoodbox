<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthAdmin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest() && $request->ajax()) {
            return response('Unauthorized.', 401);

        } elseif ($this->auth->guest()) {
            return redirect()->guest('login');

        } elseif (! $request->user()->hasRole('admin')) {
            return abort(403, 'Toegang verboden.');

        }

        return $next($request);
    }
}

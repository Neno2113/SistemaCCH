<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class FirstLogin
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
        // $id = $this->auth->user()->id;
        $first_login = $this->auth->user()->first_login;
        $role = $this->auth->user()->role;
        if($role !== 'Administrador' && $first_login == 0){
            return redirect('confirm');
        } 

        return $next($request);
    }
}

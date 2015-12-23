<?php

namespace App\Http\Middleware;

use Closure;
use Request;

Use \Sentinel;
use \Auth;


class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // dd( Sentinel::findById(Auth::user()->id)->hasAccess([Request::route()->getName()]) );
        //
        // dd( Request::route()->getMethods() );

        if(!Sentinel::findById(Auth::user()->id)->hasAccess([Request::route()->getName()])) {
            return redirect(route('admin'))->withErrors('You do not have permission to access that location.');
        }

        return $next($request);

    }
}

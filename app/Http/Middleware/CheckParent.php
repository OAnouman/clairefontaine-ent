<?php

namespace App\Http\Middleware;

use Closure;

class CheckParent
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


        $user = $request->user();

        $allowed = $user->account_type === 'eleve_parent' ;

        if ( !$allowed )

            return redirect()->route('home');



        return $next($request);


    }


}

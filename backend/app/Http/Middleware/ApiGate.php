<?php



namespace App\Http\Middleware;



class ApiGate

{

    /**

     * Handle an incoming request

     *

     * @param  \Illuminate\Http\Request $request

     * @param  \Closure $next

     * @return mixed

     */

    public function handle($request, \Closure $next)

    {

        if( ! $request->expectsJson())
        {

            return abort(403);

        }



        return $next($request);

    }

}
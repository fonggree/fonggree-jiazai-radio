<?php
/**
 * Created by PhpStorm.
 * User: costa92
 * Date: 2017/4/1
 * Time: 下午4:51
 */

namespace App\Http\Middleware;

use Closure;
use Response;

class EnableCrossRequestMiddleware
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
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type,X-Requested-With,Cookie, Accept, multipart/form-data, application/json');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'false');
        return $response;
    }

}
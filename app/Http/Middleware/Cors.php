<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        // すべてのレスポンスに CORS 用のヘッダーを追加する必要はないので URL から判断する
        $paths = explode('/', \Request::getPathInfo());
        if ($paths[1] === 'auth') {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST')
                ->header('Access-Control-Allow-Headers', 'Accept, X-Requested-With, Origin, Content-Type');
        }
        return $next($request);
    }
}

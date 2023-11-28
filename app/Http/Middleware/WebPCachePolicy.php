<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WebPCachePolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Thêm các headers để cấu hình chính sách bộ nhớ cache
//        $response->header('Cache-Control', 'public, max-age=31536000'); // Có thể điều chỉnh thời gian cache theo nhu cầu
        return $response->header('Cache-Control','no-cache, public');
    }
}

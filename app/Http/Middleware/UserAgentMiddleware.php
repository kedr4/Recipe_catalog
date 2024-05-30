<?php

namespace App\Http\Middleware;

use Closure;
use Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserAgentMiddleware
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
        $browser = Browser::browserFamily();
        $os = Browser::platformFamily();
        $ip = $request->ip();
        $visitTime = now();

        DB::table('user_infos')->insert([
            'browser' => $browser,
            'os' => $os,
            'ip' => $ip,
            'visit_time' => $visitTime,
        ]);

        return $next($request);
    }


}

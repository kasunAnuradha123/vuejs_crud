<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');
        $browser = $this->getBrowserFromUserAgent($userAgent);
        if (!User::isApproval(Auth::user()->id, $browser)) {
            $authRequest =  User::sendRequest($browser, Auth::id());
            $cookieName = "RBS-user_" . Auth::id();
            if($authRequest['approval_secret'] == null && $authRequest['approval'] == 0 && $authRequest['is_confirm'] == 0){
                $cookieTime = 1;
                $cookie = cookie($cookieName, $cookieName, $cookieTime, '/', null, false, false, false)->withSameSite('Lax');
                return redirect('/approval')->withCookie($cookie);
            }elseif($authRequest['approval'] == 0 && $authRequest['is_confirm'] == 0 ){
                $cookieTime = 1;
                $cookie = cookie($cookieName, $cookieName, $cookieTime, '/', null, false, false, false)->withSameSite('Lax');
                return redirect('/approval')->withCookie($cookie);
            }elseif( $authRequest['is_confirm'] == 0 ){
                $cookie = cookie($authRequest['approval_secret'] , $authRequest['approval_secret'] , $authRequest['time'] , '/', null, false, false, false)->withSameSite('Lax');
                return redirect('/approval')->withCookie($cookie);
            }
         
        }
        return $next($request);
    }

    private function getBrowserFromUserAgent($userAgent)
    {
        if (str_contains($userAgent, 'Firefox')) {
            return 'Firefox';
        } elseif (str_contains($userAgent, 'Chrome')) {
            return 'Chrome';
        } elseif (str_contains($userAgent, 'Safari')) {
            return 'Safari';
        } elseif (str_contains($userAgent, 'Edge')) {
            return 'Edge';
        }

        return 'Unknown';
    }
    
}

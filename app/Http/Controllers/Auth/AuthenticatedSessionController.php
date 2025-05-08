<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AuthenticationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $userAgent = $request->header('User-Agent');
        $browser = $this->getBrowserFromUserAgent($userAgent);
        $authRequest = AuthenticationRequest::where([['user_id', '=', Auth::user()->id], ['browser', '=', $browser], ['is_confirm', '=', 0]])->first();
        if ($authRequest && $authRequest->approval == 1) {
            $cookieName = $authRequest->approval_secret;
            $cookieValue = $authRequest->approval_secret;
            $cookieTime = $authRequest->time; 
            // Set the cookie
            $cookie = cookie($cookieName, $cookieValue, $cookieTime, '/', null, false, false, false)->withSameSite('Lax');
            $this->savedCookie($authRequest->id);
            return redirect()->intended(route('dashboard', absolute: false))->withCookie($cookie);

        }else{
            return redirect()->intended(route('dashboard', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function savedCookie($id)
    {
        $authRequest =  AuthenticationRequest::find($id);
        if ($authRequest) {
            $authRequest->is_confirm = 1;
            $authRequest->update();
        }
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

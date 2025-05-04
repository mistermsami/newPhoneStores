<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UsersLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
/////////////////////testing
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $userlogCheck = UsersLog::where('user_id', auth()->id())->where('date', Carbon::now()->format('Y-m-d'))->where('status', 'LOGOUT')->first();

        if ($userlogCheck) {
            $UsersLog = UsersLog::where('user_id', auth()->id())
                ->where('date', Carbon::now()->format('Y-m-d'))
                ->where('status', 'LOGOUT')
                ->update([
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'status' => 'LOGOUT',
                    'user_id' => auth()->id(),
                ]);
            // Log::channel('stderr')->info('User already logout today!');
        } else {
            $UsersLog = UsersLog::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'LOGOUT',
                'user_id' => auth()->id(),
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

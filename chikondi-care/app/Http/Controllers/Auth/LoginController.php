<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();

            if (! $user->is_active) {
                Auth::logout();

                return back()
                    ->withErrors(['email' => 'This account is inactive. Contact your administrator.'])
                    ->onlyInput('email');
            }

            $user->update(['last_login_at' => now()]);

            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'login',
                'subject' => 'Authentication',
                'description' => "{$user->name} signed in",
                'ip_address' => $request->ip(),
            ]);

            $dashboard = match ($user->role) {
                'administrator' => 'admin.dashboard',
                'receptionist' => 'receptionist.dashboard',
                'attendant' => 'attendant.dashboard',
                'doctor' => 'doctor.dashboard',
                'accountant' => 'accountant.dashboard',
                default => 'admin.dashboard',
            };

            return redirect()->intended(route($dashboard));
        }

        return back()
            ->withErrors([
                'email' => 'The email or password you entered is incorrect.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user) {
            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'logout',
                'subject' => 'Authentication',
                'description' => "{$user->name} signed out",
                'ip_address' => $request->ip(),
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

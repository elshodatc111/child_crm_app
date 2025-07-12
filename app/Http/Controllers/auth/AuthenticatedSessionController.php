<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller{

    public function create(){
        return view('auth.login');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            if (in_array($user->type, ['oshpaz', 'hodim', 'techer'])) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                throw ValidationException::withMessages([
                    'email' => 'Sizga tizimga kirishga ruxsat berilmagan.',
                ]);
            }
            if ($user->status === 'block') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                throw ValidationException::withMessages([
                    'email' => 'Sizning ish faoliyatingiz bloklangan.',
                ]);
            }
            if ($user->status === 'delete') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                throw ValidationException::withMessages([
                    'email' => 'Siz ish faoliyatingizni yakunlagansiz.',
                ]);
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        throw ValidationException::withMessages([
            'email' => 'Email yoki parol noto‘g‘ri.',
        ]);
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

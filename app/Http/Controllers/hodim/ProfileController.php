<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{

    public function profile(){
        return view('hodim.profile');
    }

    public function profile_password_update(Request $request){
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Joriy parol noto‘g‘ri.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Parol muvaffaqiyatli yangilandi.');
    }
}

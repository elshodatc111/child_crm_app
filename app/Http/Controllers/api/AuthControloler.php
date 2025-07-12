<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthControloler extends Controller{

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validatsiya xatosi',
                'errors' => $validator->errors()
            ], 422);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if($user->type == 'direktor' OR $user->type == 'tarbiyachi' OR $user->type == 'kichik_tarbiyachi' OR $user->type == 'menejer'){
                $token = $user->createToken('MyApp')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Muvaffaqiyatli login qilindi',
                    'data' => [
                        'token' => $token,
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->fio,
                            'email' => $user->email,
                            'type' => $user->type,
                        ]
                    ]
                ], 200);
            }else{
               return response()->json([
                    'success' => false,
                    'message' => 'Sizga ruxsat berilmagan'
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email yoki parol noto‘g‘ri'
            ], 401);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Muvaffaqiyatli chiqildi (logout)'
        ], 200);
    }

}

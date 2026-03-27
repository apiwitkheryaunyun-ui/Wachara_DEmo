<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'username' => 'required|string|max:60',
            'password' => 'required|string|max:255',
        ]);

        $username = trim($data['username']);

        // Convenience bootstrap for first-run demo login (local only).
        if (app()->environment('local') && !User::where('username', $username)->exists() && in_array($username, ['admin', 'stock'], true) && $data['password'] === '1234') {
            User::create([
                'username'  => $username,
                'name'      => $username === 'admin' ? 'ผู้ดูแลระบบ' : 'เจ้าหน้าที่สต็อก',
                'email'     => $username . '@wachara-stevedoring.local',
                'password'  => Hash::make('1234'),
                'role'      => $username === 'admin' ? 'admin' : 'stock',
                'is_active' => true,
            ]);
        }

        $ok = Auth::attempt([
            'username'  => $username,
            'password'  => $data['password'],
            'is_active' => 1,
        ]);

        if (!$ok) {
            return response()->json([
                'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
            ], 422);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'เข้าสู่ระบบสำเร็จ',
            'user' => [
                'id'       => (string) $request->user()->id,
                'username' => $request->user()->username,
                'name'     => $request->user()->name,
                'role'     => $request->user()->role,
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'ออกจากระบบแล้ว',
        ]);
    }
}

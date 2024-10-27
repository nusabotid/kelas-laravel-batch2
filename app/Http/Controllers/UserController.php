<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePasswordView()
    {
        // dd(Auth::user());
        return view('auth.update-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "old_password" => ["required"],
            "new_password" => ["required", "string", "min:8"],
        ], [
            "old_password.required" => "Password lama harus diisi!",
            "new_password.required" => "Password baru harus diisi!",
            "new_password.string" => "Password baru tidak valid, harus berupa huruf/angka",
            "new_password.min" => "Password baru minimal 8 karakter",
        ]);

        $oldPassInput = $request->input('old_password');
        $oldPassIsValid = Hash::check($oldPassInput, Auth::user()->password);

        if (!$oldPassIsValid) {
            return back()->with('error-password', 'Password lama tidak sesuai/tidak valid');
        }

        $user = User::where('email', Auth::user()->email)->update([
            "password" => Hash::make($request->input('new_password')),
        ]);
        // $user->password = Hash::make($request->input('new_password'));
        // $user->save();

        return back()->with('success', 'Berhasil mengubah password!');
    }
}

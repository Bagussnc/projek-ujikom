<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
   public function showLogin()
   {
      return view('auth.login');
   }

   public function login(Request $request)
   {
      $request->validate([
         'user_nama' => 'required|string',
         'user_pass' => 'required|string',
      ]);

      $user = User::where('user_nama', $request->user_nama)->first();

      if ($user && Hash::check($request->user_pass, $user->user_pass)) {
         Auth::login($user);
         return redirect()->route('superuser.dashboard')->with('success', 'Login berhasil');
      } else {
         return back()->withErrors(['login' => 'Username atau password salah']);
      }
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use voku\helper\AntiXSS;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session('user')) {
            return redirect('/dashboard');
        }
        
        $data = array(
            'title'             => 'Login',
            'menu'              => 'Login',
            'head'              => 'Login',
        );
        return view('auth/index')->with($data);
    }

    public function login(Request $request)
    {
        $validation = $request->validate([
            'username'        => 'required',
            'password'        => 'required',
            // 'g-recaptcha-response' => 'required|captcha' 
        ]);
        $antiXss = new AntiXSS();
        
        $credentials = [
            'username' => $antiXss->xss_clean($request->input('username')),
            'password' => $antiXss->xss_clean($request->input('password'))
        ];
        // $credentials = $request->only('username', 'password');
        // dd($credentials);die;
        // dd()
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            if($user->active==1){
                $request->session()->put('user', $user);
                return redirect()->intended('/dashboard');
            } else{
                return redirect('login')->with('login_active', 'Akun Sudah Tidak Aktif. Mohon Hubungi Admin');
            }
        } else {
            return redirect('/login')->with('login_gagal', 'Username atau Password Tidak Terdaftar.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user');
        return redirect('/login');
    }
}

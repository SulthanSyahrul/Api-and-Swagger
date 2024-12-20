<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {

        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Store admin ID in the session
            $request->session()->put('admin_id', Auth::id());

            Alert::success('Success', 'Login success !');
            return redirect()->intended('/dashboard');
            } else {
                Alert::error('Error', 'Login failed !');
                return redirect('/login')->withErrors(['email' => 'Email atau password salah.']);
            }
        }

    

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admin',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($request['password']);

        $admin = Admin::create($validated);
        Auth::logout();

        Alert::success('Success', 'Register admin has been successfully !');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash success alert
        Alert::success('Success', 'Log out success!');

        return redirect('/login')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
    public function reset(){
        return view('auth.reset', [
            'title' => 'Reset Password',
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:32',
        ]);

        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if ($res) {
            return back()->with('success', 'You have registered successfuly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function login()
    {
        return view('login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:32',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->Session()->put('LoginId', $user->id);
                $request->Session()->put('LoginName', $user->fullname);
                return redirect('phieu-ban-hang');
            } else {
                return back()->with('fail', 'Password not matches.');
            }
        } else {
            return back()->with('fail', 'This email is not registered.');
        }
    }

    // public function getName()
    // {
    //     if (Session::has('LoginId')) {
    //         $data = User::where('id', '=', Session::get('LoginId'))->first();
    //     }
    //     dd($data);
    //     return view('sidebar', compact('data'));
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MainUserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function edit()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('user.profile.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = Str::random(10) . '.' . $file->extension();
            $file->move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        return redirect()->back()->with('status', 'Your profile was updated!');
    }

    public function passwordView()
    {
        return view('user.password.edit');
    }

    public function passwordUpdate(Request $request)
    {
        $password = Auth::user()->password;
        $current_password = $request->current_password;
        $new_password = $request->password;
        $confirm = $request->password_confirmation;
        if (Hash::check($current_password, $password)) {
            if ($new_password === $confirm) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->route('login')->with('status', 'Password updated successfully! Please, sign in with your new password');
            } else {
                return redirect()->back()->with('status', 'New password and Confirm password not matched!');
            }
        } else {
            return redirect()->back()->with('status', 'Current password not matched!');
        }
    }
}

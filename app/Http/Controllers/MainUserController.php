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

    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('user.profile.view_profile', compact('user'));
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

        return redirect()->route('user.profile');
    }

    public function passwordView()
    {
        return view('user.password.edit');
    }

    public function passwordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}

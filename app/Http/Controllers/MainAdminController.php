<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MainAdminController extends Controller
{
    public function profile($id)
    {
        $admin = Admin::find($id);
        return view('admin.profile.view_profile', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        //$admin = Admin::find(1);
        return view('admin.profile.edit', compact('admin'));
    }

    public function store(Request $request, $id)
    {
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = Str::random(10) . '.' . $file->extension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        return redirect()->route('admin.profile', $data->id);
    }
}

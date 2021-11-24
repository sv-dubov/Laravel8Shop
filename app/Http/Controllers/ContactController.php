<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function contactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:255',
            'message' => 'required'
        ]);
        Contact::add($request->all());
        return redirect()->back()->with('status', 'We received your message and will contact you soon!');
    }
}

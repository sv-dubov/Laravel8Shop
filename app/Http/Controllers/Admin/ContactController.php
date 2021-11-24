<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $messages = Contact::all();
        return view('admin.contact.index', compact('messages'));
    }

    public function unread()
    {
        $messages = Contact::where('status', 0)->get();
        return view('admin.contact.unread', compact('messages'));
    }

    public function show($id)
    {
        $message = Contact::find($id);
        return view('admin.contact.show', compact('message'));
    }

    public function destroy($id)
    {
        Contact::find($id)->remove();
        return redirect()->route('admin.contact.index')->with('status', 'Message was deleted!');
    }

    public function status($id)
    {
        $message = Contact::find($id);
        $message->toggleRead();
        return redirect()->back()->with('status', 'Message status was updated!');
    }
}

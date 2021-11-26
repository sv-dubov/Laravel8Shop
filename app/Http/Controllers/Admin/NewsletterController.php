<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscriptions = DB::table('newsletters')->get();
        return view('admin.newsletter.index', compact('subscriptions'));
    }

    public function destroy($id)
    {
        DB::table('newsletters')->where('id', $id)->delete();
        return redirect()->route('newsletters.index')->with('status', 'Subscription was deleted successfully!');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->get('ids');
        DB::delete('delete from newsletters where id in ('.implode(",", $ids).')');
        return redirect()->route('newsletters.index')->with('status', 'Selected subscriptions was deleted successfully!');
    }
}

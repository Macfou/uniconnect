<?php

namespace App\Http\Controllers;

use App\Models\BringIn;
use App\Models\Listing;
use Illuminate\Http\Request;

class BringInController extends Controller
{
    public function spmobringinrequest($id)
{
    $event = Listing::findOrFail($id);
    $requests = BringIn::where('listings_id', $id)->get();

    return view('spmo.spmo_pages.spmo_bringin', compact('event', 'requests'));
}


    public function pending()
    {
        $requests = BringIn::with('user')->where('status', 'Pending')->get();
        return view('bringin.pending_requests', compact('requests'));
    }

    public function approved()
    {
        $requests = BringIn::with('user')->where('status', 'Approved')->get();
        return view('bringin.approve_requests', compact('requests'));
    }

    public function rejected()
    {
        $requests = BringIn::with('user')->where('status', 'Rejected')->get();
        return view('bringin.rejected_requests', compact('requests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $bringIn = BringIn::findOrFail($id);
        $bringIn->status = $request->status;
        $bringIn->save();

        return redirect()->back()->with('success', 'Request updated successfully.');
    }
}

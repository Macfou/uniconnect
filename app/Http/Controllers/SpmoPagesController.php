<?php

namespace App\Http\Controllers;

use App\Models\Spmo;
use App\Models\BringIn;
use Illuminate\Http\Request;
use App\Models\PermitTransfer;
use App\Models\SpmoBorrowRequest;
use Illuminate\Support\Facades\DB;

class SpmoPagesController extends Controller
{
    public function spmodashboard(Request $request) {
        $pendingBorrowCount = SpmoBorrowRequest::where('status', 'Pending')->count();
        $pendingBringInCount = BringIn::where('status', 'Pending')->count();
        $pendingPermitTransferCount = PermitTransfer::where('status', 'Pending')->count();
        $spmoUserCount = Spmo::count();
    
        $month = $request->input('month');
        $year = $request->input('year');
    
        $mostBorrowedQuery = SpmoBorrowRequest::select('equipment_id', DB::raw('COUNT(*) as total'))
            ->where('status', 'Returned');
    
        if ($month && $year) {
            $mostBorrowedQuery->whereMonth('created_at', $month)->whereYear('created_at', $year);
        } elseif ($year) {
            $mostBorrowedQuery->whereYear('created_at', $year);
        }
    
        $mostBorrowed = $mostBorrowedQuery->groupBy('equipment_id')
            ->orderByDesc('total')
            ->take(5)
            ->with('equipment')
            ->get();
    
        return view('spmo.spmo_pages.spmo_dashboard', compact(
            'pendingBorrowCount',
            'pendingBringInCount',
            'pendingPermitTransferCount',
            'spmoUserCount',
            'mostBorrowed',
            'month',
            'year'
        ));
    }
    
    
    

    public function spmocategory() {
        return view('spmo.spmo_pages.spmo_category');
    }

    public function spmoinventory() {
        return view('spmo.spmo_pages.spmo_inventory');
    }

    public function spmoborrowed() {
        return view('spmo.spmo_pages.spmo_borrowed');
    }

    public function spmopending() {
        return view('spmo.spmo_pages.spmo_pending');
    }

    public function spmoapproved() {
        return view('spmo.spmo_pages.spmo_approved');
    }

    public function spmocancelled() {
        return view('spmo.spmo_pages.spmo_cancelled');
    }
}

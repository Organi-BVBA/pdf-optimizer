<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Organi\Helpers\Formatters\Bytes;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $total      = Auth::user()->total_uploaded;
        $optimized  = Auth::user()->total_optimized;
        $saved      = $total - $optimized;
        $percentage = 0;

        if ($total > 0) {
            $percentage = (int) ($saved / Auth::user()->total_uploaded * 100);
        }

        // Format output
        $total     = Bytes::formatBinary($total);
        $optimized = Bytes::formatBinary($optimized);
        $saved     = Bytes::formatBinary($saved);

        $count = Auth::user()->webhooks()->count();

        return Inertia::render('Dashboard', compact('total', 'optimized', 'saved', 'percentage', 'count'));
    }
}

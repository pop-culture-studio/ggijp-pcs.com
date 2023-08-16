<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $materials = $request->user()
            ->materials()
            ->latest('id')
            ->paginate();

        return view('dashboard.dashboard')->with(compact('materials'));
    }
}

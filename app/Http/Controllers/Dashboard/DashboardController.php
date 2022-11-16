<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $materials = $request->user()
                             ->materials()
                             ->latest('id')
                             ->paginate();

        return view('dashboard.dashboard')->with(compact('materials'));
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactPreviewController extends Controller
{
    public function __invoke(Request $request, Contact $contact): View
    {
        return view('dashboard.preview')->with(compact('contact'));
    }
}

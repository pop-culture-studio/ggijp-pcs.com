<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactPreviewController extends Controller
{
    public function __invoke(Request $request, Contact $contact)
    {
        return view('dashboard.preview')->with(compact('contact'));
    }
}

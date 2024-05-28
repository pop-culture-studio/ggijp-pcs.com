<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __invoke(Request $request): View
    {
        $contacts = Contact::latest()->paginate();

        return view('dashboard.contacts')->with(compact('contacts'));
    }
}

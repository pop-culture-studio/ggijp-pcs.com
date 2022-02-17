<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        $contacts = Contact::latest()->paginate();

        return view('dashboard.contacts')->with(compact('contacts'));
    }
}

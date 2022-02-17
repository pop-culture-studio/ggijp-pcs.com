<?php

namespace App\Http\Livewire;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $body = '';

    public array $rules = [
        'name' => 'required',
        'email' => ['required', 'email'],
        'body' => 'required',
    ];

    public function ready(Request $request)
    {
        $this->name = $request->cookie('name', '');
        $this->email = $request->cookie('email', '');
    }

    public function sendmail()
    {
        $this->validate();

        Contact::forceCreate([
            'name' => $this->name,
            'email' => $this->email,
            'body' => trim($this->body),
        ]);

        Cookie::queue('name', $this->name, 60 * 24 * 30);
        Cookie::queue('email', $this->email, 60 * 24 * 30);

        Mail::to(config('pcs.contact.mail'))
            ->send(new ContactMail($this->name, $this->email, $this->body));

        $this->reset();

        session()->flash('mail_success', true);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

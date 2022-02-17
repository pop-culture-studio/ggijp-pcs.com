<?php

namespace App\Http\Livewire;

use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;
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

        Cookie::queue('name', $this->name, 60 * 24 * 30);
        Cookie::queue('email', $this->email, 60 * 24 * 30);

        Notification::route('mail', config('pcs.contact.mail'))
                    ->route('line-notify', config('line.notify.personal_access_token'))
                    ->notify(new ContactNotification($this->name, $this->email, $this->body));

        $this->reset();

        session()->flash('mail_success', true);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

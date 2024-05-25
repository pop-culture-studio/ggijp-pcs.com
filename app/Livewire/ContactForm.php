<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required')]
    public string $name = '';
    #[Validate('required|email')]
    public string $email = '';
    #[Validate('required')]
    public string $body = '';

    public function ready(Request $request): void
    {
        $this->name = $request->cookie('name', '');
        $this->email = $request->cookie('email', '');
    }

    public function sendmail(): void
    {
        $this->validate();

        Cookie::queue('name', $this->name, 60 * 24 * 30);
        Cookie::queue('email', $this->email, 60 * 24 * 30);

        Contact::forceCreate([
            'name' => $this->name,
            'email' => $this->email,
            'body' => trim($this->body),
        ]);

        $this->reset();

        session()->flash('mail_success', true);
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class RequestForm extends Component
{
    public string $body = '';

    public array $rules = [
        'body' => 'required',
    ];

    public function sendmail()
    {
        $this->validate();

        Contact::forceCreate([
            'name' => '【リクエスト・メッセージ】',
            'email' => config('pcs.contact.mail'),
            'body' => trim($this->body),
        ]);

        $this->reset();

        session()->flash('mail_success', true);
    }

    public function render()
    {
        return view('livewire.request-form');
    }
}

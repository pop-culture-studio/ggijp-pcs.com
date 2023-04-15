<?php

namespace Tests\Feature\Material;

use App\Http\Livewire\ContactForm;
use App\Notifications\ContactNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_contact_page(): void
    {
        $response = $this->get(route('form.contact'));

        $response->assertStatus(200)
                 ->assertSeeLivewire('contact-form');
    }

    public function test_contact_ready(): void
    {
        Livewire::test(ContactForm::class)
                ->call('ready', Request::create(uri: '/', cookies: ['name' => 'test', 'email' => 'test@localhost']))
                ->assertSet('name', 'test')
                ->assertSet('email', 'test@localhost');
    }

    public function test_contact_sendmail(): void
    {
        Notification::fake();

        Livewire::test(ContactForm::class)
                ->set('name', 'test')
                ->set('email', 'test@localhost')
                ->set('body', 'test')
                ->call('sendmail')
                ->assertSet('name', '')
                ->assertSet('email', '')
                ->assertSet('body', '');

        Notification::assertSentOnDemand(ContactNotification::class);
    }
}

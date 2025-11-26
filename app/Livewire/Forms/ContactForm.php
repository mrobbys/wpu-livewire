<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Contact;

class ContactForm extends Form
{
    public $email, $subject, $message;

    public function store()
    {
        $this->validate(
            [
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'subject.required' => 'Subjek wajib diisi.',
                'message.required' => 'Pesan wajib diisi.',
            ],
            [
                'email' => 'Email',
                'subject' => 'Subjek',
                'message' => 'Pesan',
            ]
        );

        Contact::create([
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();

        session()->flash('message', 'Pesan Anda telah dikirim.');
    }
}

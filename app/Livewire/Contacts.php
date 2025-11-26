<?php

namespace App\Livewire;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Contacts')]
class Contacts extends Component
{
    public ContactForm $form;

    public function submit()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.contacts');
    }
}

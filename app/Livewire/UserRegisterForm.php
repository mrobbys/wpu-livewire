<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserRegisterForm extends Component
{
    use WithFileUploads;

    public $name = '';
    public $email = '';
    public $password = '';
    public $avatar;

    public function createUser()
    {
        $validatedData = $this->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email:dns|unique:users,email',
                'password' => 'required|string|min:6',
                'avatar' => 'nullable|image|max:2048',
            ],
            [
                '*.required' => ':attribute harus diisi.',
                '*.string' => ':attribute harus berupa teks.',
                '*.min' => ':attribute minimal :min karakter.',
                '*.max' => ':attribute maksimal :max karakter.',

                'email.email' => 'Format :attribute tidak valid.',
                'email.unique' => ':attribute sudah terdaftar.',
                'avatar.image' => ':attribute harus berupa file gambar.',
            ],
            [
                'name' => 'Nama',
                'email' => 'Email',
                'password' => 'Password',
                'avatar' => 'Avatar',
            ]
        );

        if (isset($validatedData['avatar'])) {
            $validatedData['avatar'] = $this->avatar->store('avatars', 'public');
        }

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'avatar' => $validatedData['avatar'] ?? null,
        ]);

        $this->reset();

        session()->flash('message', 'User created successfully.');
        $this->dispatch('userCreated');
    }

    public function render()
    {
        return view('livewire.user-register-form');
    }
}

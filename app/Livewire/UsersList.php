<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UsersList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('userCreated')]
    public function handleUserCreated()
    {
        $this->resetPage();
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->delete();
            // Dispatch event dengan pesan
            $this->dispatch('user-deleted', message: 'User deleted successfully.');
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.users-list', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(5)->onEachSide(1),
        ]);
    }
}

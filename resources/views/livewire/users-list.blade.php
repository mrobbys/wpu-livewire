<div wire:poll.keep-alive class="w-full max-w-3xl my-10" x-data="{ showToast: false, toastMessage: '' }"
    @user-deleted.window="showToast = true; toastMessage = $event.detail.message; setTimeout(() => showToast = false, 5000)">

    <div class="mx-auto">
        <h2 class="my-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Users List</h2>
    </div>

    <div class="max-w-lg mx-auto">
        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live.debounce.250ms="search" type="search" id="search" name="search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500    -500 -500"
                placeholder="Search Users..." />
        </div>
    </div>

    <!-- Toast Notification -->
    <div x-cloak x-show="showToast" x-transition id="toast-success"
        class="mx-auto my-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-green-100 rounded-lg shadow-sm "
        role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal" x-text="toastMessage"></div>
    </div>

    @if ($users->count())
        <ul role="list" class="divide-y divide-white/5">
            @foreach ($users as $user)
                <li class="flex justify-between gap-x-6 py-6">
                    <div class="flex min-w-0 gap-x-4">
                        @if ($user->avatar && Storage::disk('public')->exists($user->avatar))
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s avatar"
                                class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
                        @else
                            <img src="{{ asset('img/avatar.png') }}" alt="{{ $user->name }}'s avatar"
                                class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
                        @endif
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm/6 font-semibold">{{ $user->name }}</p>
                            <p class="mt-1 truncate text-xs/5 text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="shrink-0 flex flex-row items-center justify-center gap-4">
                        <p class="mt-1 text-xs/5 text-gray-400">Bergabung {{ $user->created_at->diffForHumans() }}</p>
                        <!-- filepath: /Users/robbys/WebProjects/Belajar/WPU/wpu-livewire/resources/views/livewire/users-list.blade.php -->
                        <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative w-fit"
                            x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
                            <!-- Toggle Button -->
                            <button type="button" x-on:click="isOpen = ! isOpen"
                                class="inline-flex items-center gap-2 whitespace-nowrap rounded-sm border border-neutral-300 bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 "
                                aria-haspopup="true" x-on:keydown.space.prevent="openedWithKeyboard = true"
                                x-on:keydown.enter.prevent="openedWithKeyboard = true"
                                x-on:keydown.down.prevent="openedWithKeyboard = true"
                                x-bind:class="isOpen || openedWithKeyboard ? 'text-neutral-900' :
                                    'text-neutral-600'"
                                x-bind:aria-expanded="isOpen || openedWithKeyboard">
                                Actions
                                <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
                                x-on:click.outside="isOpen = false, openedWithKeyboard = false"
                                x-on:keydown.down.prevent="$focus.wrap().next()"
                                x-on:keydown.up.prevent="$focus.wrap().previous()"
                                class="absolute top-11 left-0 flex w-fit min-w-48 flex-col overflow-hidden rounded-sm border border-neutral-300 bg-neutral-50 py-1.5"
                                role="menu">
                                <button type="button" wire:click="deleteUser({{ $user->id }})"
                                    x-on:click="isOpen = false; openedWithKeyboard = false"
                                    wire:confirm="Yakin hapus data user {{ $user->name }}?"
                                    class="w-full text-start cursor-pointer bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/10 focus-visible:text-neutral-900 focus-visible:outline-hidden"
                                    role="menuitem">Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="my-5 text-gray-500 text-center">No users found😢😢😢</p>
    @endif

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

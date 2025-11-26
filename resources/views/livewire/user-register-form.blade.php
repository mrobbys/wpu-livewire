<div class="w-full max-w-md my-10">

    <div class="mx-auto">
        <h2 class="my-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create New User</h2>
    </div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition id="toast-success"
            class="mx-auto flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-green-100 rounded-lg shadow-sm "
            role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('message') }}</div>
        </div>
    @endif

    <div class="mt-10">
        <form wire:submit.prevent="createUser" class="space-y-6">
            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                <div class="mt-2">
                    <input id="name" type="text" name="name" wire:model="name" autocomplete="off" autofocus
                        class="block w-full rounded-md {{ $errors->has('name') ? 'border-red-500' : 'border-gray-800' }} bg-gray-100 border px-3 py-1.5 text-base text-gray-900 sm:text-sm/6" />
                </div>
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email" type="email" name="email" wire:model="email" autocomplete="off"
                        class="block w-full rounded-md {{ $errors->has('email') ? 'border-red-500' : 'border-gray-800' }} bg-gray-100 border px-3 py-1.5 text-base text-gray-900 sm:text-sm/6" />
                </div>
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" type="password" name="password" wire:model="password" autocomplete="off"
                        class="block w-full rounded-md {{ $errors->has('password') ? 'border-red-500' : 'border-gray-800' }} bg-gray-100 border px-3 py-1.5 text-base text-gray-900 sm:text-sm/6" />
                </div>
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-span-full">
                <label for="profile-picture" class="block text-sm/6 font-medium">Profile
                    Picture</label>
                <div
                    class="mt-2 flex justify-center rounded-lg border {{ $errors->has('avatar') ? 'border-red-500' : 'border-dashed' }} px-6 py-6">
                    <div class="text-center">
                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                            class="mx-auto size-12 text-gray-600">
                            <path
                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm/6 text-gray-400 justify-center">
                            <label for="avatar"
                                class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-500 hover:text-indigo-300">
                                <span wire:loading.remove wire:target="avatar">Upload a file</span>
                                <span wire:loading wire:target="avatar">Uploading...</span>
                                <input wire:model="avatar" id="avatar" type="file" name="avatar" class="sr-only"
                                    accept="image/png, image/jpg, image/jpeg" />
                            </label>
                        </div>
                        <p class="text-xs/5 text-gray-400">PNG, JPG, JPEG, Max Size 2MB</p>
                        @if ($avatar && !$errors->has('avatar'))
                            <small wire:loading.remove wire:target="avatar" class="text-green-500">✅ Upload
                                Success</small>
                        @endif
                    </div>
                </div>
                @error('avatar')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            @if ($avatar)
                <div class="mt-4">
                    <p class="text-sm/6 font-medium text-gray-900 mb-2">Photo Preview:</p>
                    <img src="{{ $avatar->temporaryUrl() }}" alt="Photo Preview"
                        class="w-52 h-52 object-cover rounded-full">
                </div>
            @endif

            <div>
                <button type="submit" wire:target='createUser, avatar' wire:loading.attr="disabled"
                    wire:loading.class.remove="bg-indigo-600 cursor-pointer hover:bg-indigo-500"
                    wire:loading.class="bg-indigo-400 cursor-not-allowed"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 cursor-pointer">
                    <span wire:loading.remove wire:target='createUser'>Create User</span>
                    <span wire:loading wire:target='createUser'>Loading...</span>
                </button>
            </div>
        </form>
    </div>
</div>

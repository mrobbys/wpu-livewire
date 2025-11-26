<div class="my-10">
    <section class="bg-white">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-3xl">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 ">Contact Us
            </h2>
            <p class="mb-8 font-light text-center text-gray-500 sm:text-xl">Ingin menghubungi kami? Ajukan pertanyaan,
                saran, atau permintaan informasi melalui formulir berikut.
            </p>

            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition id="toast-success"
                    class="mx-auto flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-green-100 rounded-lg shadow-sm "
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
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

            <form wire:submit.prevent="submit" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Anda</label>
                    <input type="email" id="email" wire:model="form.email"
                        class="shadow-sm bg-gray-50 border {{ $errors->has('form.email') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="john@gmail.com" autofocus>
                    @error('form.email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Subjek</label>
                    <input type="text" id="subject" wire:model="form.subject"
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border {{ $errors->has('form.subject') ? 'border-red-500' : 'border-gray-300' }} shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Berikan subjek pesan Anda">
                    @error('form.subject')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Pesan</label>
                    <textarea id="message" rows="6" wire:model="form.message"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border {{ $errors->has('form.message') ? 'border-red-500' : 'border-gray-300' }} focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Berikan pesan Anda..."></textarea>
                    @error('form.message')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" wire:loading.attr="disabled"
                    wire:loading.class="bg-blue-400 cursor-not-allowed"
                    wire:loading.class.remove="bg-blue-700 hover:bg-blue-800 cursor-pointer"
                    class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 cursor-pointer">
                    <span wire:loading.remove>Kirim pesan</span>
                    <span wire:loading>Loading...</span>
                </button>
            </form>
        </div>
    </section>
</div>

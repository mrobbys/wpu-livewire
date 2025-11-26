<nav class="bg-white -900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 -600">
    <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" wire:navigate class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap ">WPU Livewire</span>
        </a>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white -800 md:-900 -700">
                <li>
                    <a href="{{ route('home') }}" wire:navigate
                        class="block py-2 px-3 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 {{ request()->routeIs('home') ? 'text-blue-500' : 'text-gray-900' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('users') }}" wire:navigate
                        class="block py-2 px-3 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 {{ request()->routeIs('users') ? 'text-blue-500' : 'text-gray-900' }}">Users</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" wire:navigate
                        class="block py-2 px-3 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 {{ request()->routeIs('about') ? 'text-blue-500' : 'text-gray-900' }}">About</a>
                </li>
                <li>
                    <a href="{{ route('contacts') }}" wire:navigate
                        class="block py-2 px-3 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 {{ request()->routeIs('contacts') ? 'text-blue-500' : 'text-gray-900' }}">Contacts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

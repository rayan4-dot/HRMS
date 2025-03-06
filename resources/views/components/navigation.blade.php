<!-- User Profile Dropdown -->
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-orange-500 rounded-full p-1 transition-all duration-200 hover:bg-orange-100">
        <div class="flex items-center space-x-3">
            <!-- Profile Picture -->
            @if(Auth::user()->profile_photo_path)
                <img class="h-10 w-10 rounded-full object-cover ring-2 ring-orange-200 shadow-md transition-transform duration-200 hover:scale-105"
                     src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                     alt="{{ Auth::user()->name }}">
            @else
                <div class="h-10 w-10 rounded-full bg-orange-600 flex items-center justify-center ring-2 ring-orange-200 shadow-md transition-transform duration-200 hover:scale-105">
                    <span class="text-white text-base font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
            @endif
            <!-- User Name -->
            <span class="text-blue-900 dark:text-blue-200 font-large text-xl hidden md:inline">
            {{ Auth::user()->name }}
            </span>
            <!-- Dropdown Arrow -->
            <svg class="h-5 w-5 text-orange-600 dark:text-orange-400 transform transition-transform duration-200"
                 :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </button>

    <!-- Dropdown Content -->
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl bg-white dark:bg-gray-800 border border-orange-200 ring-1 ring-orange-100 z-50">
        <div class="py-1 rounded-lg overflow-hidden">
            <a href="{{ route('profile.show') }}"
               class="block px-4 py-2 text-sm text-orange-900 dark:text-orange-100 font-medium hover:bg-orange-50 dark:hover:bg-orange-700 transition-colors duration-200">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-orange-900 dark:text-orange-100 font-medium hover:bg-orange-50 dark:hover:bg-orange-700 transition-colors duration-200">
                    Sign out
                </button>
            </form>
        </div>
    </div>
</div>
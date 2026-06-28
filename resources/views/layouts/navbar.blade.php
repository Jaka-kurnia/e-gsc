<header class="bg-slate-50 shadow-sm">
    <div class="flex justify-between items-center px-4 md:px-6 py-2.5 md:py-3">
        <div class="flex items-center">
            <button onclick="toggleSidebar(); document.getElementById('overlay').classList.toggle('hidden');"
                class="mr-3 text-gray-600 md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="flex items-center space-x-1 md:space-x-2 relative" x-data="{ open: false }">

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center space-x-1.5 md:space-x-2 p-1 md:p-1.5 rounded-full border-2 border-indigo-200 hover:bg-indigo-50 focus:outline-none transition-colors">
                    <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-gray-200 overflow-hidden shrink-0">
                        <img src="#" alt="User profile" class="w-full h-full object-cover">
                    </div>
                    <span
                        class="text-gray-700 font-medium text-xs md:text-sm pr-1.5 md:pr-2 hidden sm:inline-block">User
                        Name</span>
                    <svg class="w-3.5 h-3.5 text-gray-500 hidden sm:block mr-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
                    <div class="px-4 py-2.5 border-b border-gray-200 bg-gray-50">
                        <div class="font-medium text-sm text-gray-900">User Name</div>
                        <div class="text-xs text-gray-500 truncate">user@example.com</div>
                        <div class="text-xs text-gray-400 mt-0.5 capitalize">Role</div>
                    </div>

                    <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fi fi-rs-user text-base leading-none w-5 mr-2"></i>
                            <span>Profile</span>
                        </a>
                        <form method="POST" action="#">
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fi fi-rs-sign-out-alt text-base leading-none w-5 mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</header>

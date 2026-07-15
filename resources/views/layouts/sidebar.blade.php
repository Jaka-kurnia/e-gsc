<div class="flex items-center justify-between px-6 py-5">
    <div class="text-gray-200 text-2xl font-bold flex items-center">
        <img src="#" alt="Logo" class="w-10 h-10 object-contain">
        <span class="ml-2 text-lg">E-GSC</span>
    </div>
    <button onclick="toggleSidebar()" class="md:hidden text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<aside class="mt-4 space-y-2">
    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rr-layout-fluid text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Dashboard</span>
        </a>
    </div>
    <div class="mr-4 w-64">
        {{-- Memeriksa apakah route yang aktif adalah ibu atau anak untuk otomatis membuka dropdown --}}
        <details class="group"
            {{ request()->routeIs('ibu.*') || request()->routeIs('anak.*') || request()->routeIs('jadwal.*') || request()->routeIs('imunisasi.*') ? 'open' : '' }}>
            <summary
                class="flex items-center justify-between px-4 py-3 rounded-lg ml-3 cursor-pointer list-none transition-colors
            {{ request()->routeIs('ibu.*') ||
            request()->routeIs('anak.*') ||
            request()->routeIs('jadwal.*') ||
            request()->routeIs('imunisasi.*')
                ? 'bg-indigo-600 text-white font-semibold'
                : 'text-gray-200 hover:bg-indigo-500' }}">
                <div class="flex items-center flex-1">
                    <i class="fi fi-rs-box text-lg leading-none relative top-0.5"></i>
                    <span class="ml-3 font-medium">Data Master</span>
                </div>
                <span
                    class="transition transform group-open:rotate-180 {{ request()->routeIs('ibu.*') || request()->routeIs('anak.*') || request()->routeIs('jadwal.*') || request()->routeIs('imunisasi.*') ? 'text-white' : 'text-gray-400' }}">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </span>
            </summary>

            <div class="mt-1 ml-7 flex flex-col space-y-1 border-l border-gray-700 pl-2">
                {{-- Submenu Anak --}}
                <a href="{{ route('anak.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('anak.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('anak.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Anak</span>
                </a>

                {{-- Submenu Orang Tua (Ibu) --}}
                <a href="{{ route('ibu.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('ibu.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('ibu.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Orang Tua</span>
                </a>

                <a href="{{ route('jadwal.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('jadwal.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('jadwal.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Jadwal</span>
                </a>
                <a href="{{ route('imunisasi.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('imunisasi.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('imunisasi.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Imunisasi</span>
                </a>

            </div>
        </details>
    </div>

    <div class="mr-4 w-64">
        {{-- Memeriksa apakah route yang aktif adalah ibu atau anak untuk otomatis membuka dropdown --}}
        <details class="group"
            {{ request()->routeIs('pemeriksaan.*') || request()->routeIs('pemeriksaan_antropometri.*') || request()->routeIs('pemeriksaan_konseling.*') ? 'open' : '' }}>
            <summary
                class="flex items-center justify-between px-4 py-3 rounded-lg ml-3 cursor-pointer list-none transition-colors
            {{ request()->routeIs('pemeriksaan.*') ||
            request()->routeIs('pemeriksaan_antropometri.*') ||
            request()->routeIs('pemeriksaan_konseling.*')
                ? 'bg-indigo-600 text-white font-semibold'
                : 'text-gray-200 hover:bg-indigo-500' }}">
                <div class="flex items-center flex-1">
                    <i class="fi fi-rs-box text-lg leading-none relative top-0.5"></i>
                    <span class="ml-3 font-medium">Data Pemeriksaan</span>
                </div>
                <span
                    class="transition transform group-open:rotate-180 {{ request()->routeIs('pemeriksaan.*') || request()->routeIs('pemeriksaan_antropometri.*') || request()->routeIs('pemeriksaan_konseling.*') ? 'text-white' : 'text-gray-400' }}">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </span>
            </summary>

            <div class="mt-1 ml-7 flex flex-col space-y-1 border-l border-gray-700 pl-2">

                <a href="{{ route('pemeriksaan.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('pemeriksaan.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('pemeriksaan.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Pendaftaran</span>
                </a>

                <a href="{{ route('pemeriksaan_antropometri.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('pemeriksaan_antropometri.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('pemeriksaan_antropometri.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Meja 2 Antropometri</span>
                </a>

                <a href="{{ route('pemeriksaan_konseling.index') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-md transition-colors group/item
                {{ request()->routeIs('pemeriksaan_konseling.*')
                    ? 'text-white bg-indigo-500/40 font-medium'
                    : 'text-gray-400 hover:text-white hover:bg-indigo-500/30' }}">
                    <i
                        class="fi fi-rr-bullet text-lg mr-3 {{ request()->routeIs('pemeriksaan_konseling.*') ? 'text-white' : 'text-indigo-400 group-hover/item:text-indigo-200' }}"></i>
                    <span>Meja 3 Konseling</span>
                </a>

            </div>
        </details>
    </div>

    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-circle-user text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Profile Pengguna</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-time-past text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Riwayat</span>
        </a>
    </div>
    {{-- <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-diploma text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Hasil Kelulusan</span>
        </a>
    </div>

    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rr-calendar-clock text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Jadwal</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-users text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Data Pendaftar</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-test text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Seleksi Ujian</span>
        </a>
    </div> --}}
    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-megaphone text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Pengumuman</span>
        </a>
    </div>
    <div class="flex items-center mr-4">
        <a href="#" class="flex items-center flex-1 px-4 py-3 text-gray-200 hover:bg-indigo-500 rounded-lg ml-3">
            <i class="fi fi-rs-settings text-lg leading-none relative top-0.5"></i>
            <span class="ml-3 font-medium">Role Management</span>
        </a>
    </div>
</aside>

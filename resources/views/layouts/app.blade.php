<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @isset($title)
            {{ $title }} | E-GSC
        @endisset {{ config('app.name', 'E-GSC') }}
    </title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    {{-- Icon FlatIcon --}}
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>

    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Overlay -->
        <div id="overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-white shadow-sm bg-opacity-50 z-20 hidden md:hidden"></div>

        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed md:static w-64 bg-indigo-950 h-full border-r border-gray-200 z-30 transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">


            <!-- Sidebar -->
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            @if (session('success'))
                <x-toast-success>{{ session('success') }}</x-toast-success>
            @elseif (session('error'))
                <x-toast-danger>{{ session('error') }}</x-toast-danger>
            @elseif (session('warning'))
                <x-toast-warning>{{ session('warning') }}</x-toast-warning>
            @endif

            <!-- Navigation -->
            @include('layouts.navbar')

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-4 md:p-8">
                <!-- Content would go here -->
                @isset($header)
                    <div class="mb-6 flex justify-between items-center">
                        {{ $header }}
                    </div>
                @endisset
                {{ $slot }}
            </div>
        </div>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangkap Session Success (Misal: Berhasil Login, Berhasil Logout, Ubah Role)
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Menangkap Session Error Umum / Kredensial Salah
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#d33'
                });
            @endif

            // Menangkap Error Validasi Laravel ($errors)
            @if ($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Form tidak boleh kosong',
                    text: "{{ $errors->first() }}",
                    confirmButtonColor: '#3085d6'
                });
            @endif
        });
    </script>

    @include('layouts.script')

</body>

</html>

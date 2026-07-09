@props(['disabled' => false, 'name' => null])

@php
    $hasError = $name ? $errors->has($name) : false;
@endphp

<div class="relative w-full" x-data="{
    // Sinkronisasi otomatis jika menggunakan x-model dari luar
    value: @entangle($attributes->wire('model')).defer || ''
}">
    <input type="date" @disabled($disabled)
        {{ $attributes->merge([
            'class' =>
                // Base Class Style khas Tabler (Padding, font, tinggi pas, & custom icon)
                'block w-full rounded-md text-sm text-neutral-800 bg-white border pr-3 pl-10 py-2 transition-all duration-200 ease-in-out ' .
                'appearance-none [color-scheme:light] ' .
                // State Normal (Border abu tipis khas Tabler & soft shadow)
                'border-neutral-300 shadow-[0_1px_3px_0_rgba(0,0,0,0.05)] ' .
                'focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none ' .
                // State Error (Jika validasi Laravel gagal)
                ($hasError ? '!border-red-500 !text-red-900 !focus:border-red-500 !focus:ring-red-500/10' : '') .
                ' ' .
                // State Disabled
                ($disabled ? 'bg-neutral-100/80 text-neutral-400 border-neutral-200 cursor-not-allowed select-none' : ''),
        ]) }}
        @if ($name) name="{{ $name }}" @endif />

    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4 {{ $hasError ? 'text-red-400' : ($disabled ? 'text-neutral-300' : 'text-neutral-400') }}"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
            <path d="M16 3v4" />
            <path d="M8 3v4" />
            <path d="M4 11h16" />
            <path d="M11 15h1" />
            <path d="M12 15v3" />
        </svg>
    </div>
</div>

<style>
    /* Menyembunyikan icon kalender bawaan browser di sisi kanan agar tidak double */
    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>

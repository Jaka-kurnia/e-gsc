@props(['disabled' => false, 'name' => null])

@php
    $hasError = $name ? $errors->has($name) : false;
@endphp

<select @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            'form-select w-full rounded-md text-sm text-neutral-800 bg-white transition-colors duration-150 ' .
            // State Normal (Gaya Khas Tabler)
            'border-neutral-200 shadow-[inset_0_1px_1px_rgba(0,0,0,0.075)] ' .
            'focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none ' .
            // State Error (Jika validasi gagal)
            ($hasError ? '!border-red-500 !focus:border-red-500 !focus:ring-red-500/10' : '') . ' ' .
            // State Disabled
            ($disabled ? 'bg-neutral-50 text-neutral-400 cursor-not-allowed select-none' : ''),
    ]) }}
    @if ($name) name="{{ $name }}" @endif>
    {{ $slot }}
</select>
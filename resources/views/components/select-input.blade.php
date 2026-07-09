@props(['disabled' => false, 'name' => null])

@php
    $hasError = $name ? $errors->has($name) : false;
@endphp

<select @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            // Base Class Style khas Tabler (Tinggi pas, padding, font, dan bg kustom arrow)
            'form-select block w-full rounded-md text-sm text-neutral-800 bg-white border pr-10 pl-3 py-2 transition-all duration-200 ease-in-out ' .
            'appearance-none bg-[url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\'%3e%3cpath fill=\'none\' stroke=\'%236c757d\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'m2 5 6 6 6-6\'/%3e%3c/svg%3e")] bg-[length:16px_16px] bg-[right_0.75rem_center] bg-no-repeat ' .
            
            // State Normal (Border abu tipis khas Tabler & soft shadow)
            'border-neutral-300 shadow-[0_1px_3px_0_rgba(0,0,0,0.05)] ' .
            'focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none ' .
            
            // State Error (Jika validasi Laravel gagal)
            ($hasError ? '!border-red-500 !text-red-900 bg-[url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\'%3e%3cpath fill=\'none\' stroke=\'%23dc3545\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'m2 5 6 6 6-6\'/%3e%3c/svg%3e")] !focus:border-red-500 !focus:ring-red-500/10' : '') . ' ' .
            
            // State Disabled (Kondisi terkunci)
            ($disabled ? 'bg-neutral-100/80 text-neutral-400 border-neutral-200 cursor-not-allowed select-none bg-[url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\'%3e%3cpath fill=\'none\' stroke=\'%23a3a3a3\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'m2 5 6 6 6-6\'/%3e%3c/svg%3e")]' : ''),
    ]) }}
    @if ($name) name="{{ $name }}" @endif>
    {{ $slot }}
</select>
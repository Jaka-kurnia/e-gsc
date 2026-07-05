@props([
    'placeholder' => 'Cari data...',
    'name' => 'search',
    'value' => request('search'),
])

<div class="relative w-full max-w-xs">
    <!-- Icon Search (Flaticon) -->
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <i class="fi fi-rr-search text-gray-400 text-base leading-none"></i>
    </div>

    <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => '
                        block w-full h-10 pl-9 pr-4 text-sm text-neutral-800 bg-white rounded-md 
                        placeholder:text-neutral-400 border border-neutral-200 transition-colors duration-150
                        focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none
                        shadow-[inset_0_1px_1px_rgba(0,0,0,0.075)]
                    ',
        ]) }}>
</div>

@props(['type' => 'button'])

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => '
               inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-700 focus:shadow-outline focus:outline-none
    
            ',
    ]) }}>
    {{ $slot }}
</button>

@props(['type' => 'submit'])

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' => '
               inline-flex items-center justify-center px-3 py-1.5 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-yellow-500 rounded-md hover:bg-yellow-600 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600 focus:shadow-outline focus:outline-none
            ',
    ]) }}>
    {{ $slot }}
</button>

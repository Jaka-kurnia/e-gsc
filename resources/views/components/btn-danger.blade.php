<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>

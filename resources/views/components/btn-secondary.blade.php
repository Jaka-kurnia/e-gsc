@props(['type' => 'button'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => '
            inline-flex
            items-center
            justify-center
            gap-2
            rounded-lg
            bg-gray-600
            px-4
            py-2
            text-sm
            font-medium
            text-white
            shadow-sm
            transition
            duration-200
            hover:bg-gray-700
            focus:outline-none
            focus:ring-2
            focus:ring-gray-500
            focus:ring-offset-2
            disabled:cursor-not-allowed
            disabled:opacity-50
        '
    ]) }}
>
    {{ $slot }}
</button>
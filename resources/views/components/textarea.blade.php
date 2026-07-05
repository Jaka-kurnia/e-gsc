@props(['disabled' => false, 'rows' => '2'])

<textarea
    @disabled($disabled)
    rows="{{ $rows }}"
    {{ $attributes->merge([
        'class' => '
            flex w-full px-3 py-2 text-sm text-neutral-800 bg-white rounded-md placeholder:text-neutral-400 transition-colors duration-150 border border-neutral-200 shadow-[inset_0_1px_1px_rgba(0,0,0,0.075)] focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none disabled:bg-neutral-50 disabled:text-neutral-400 disabled:cursor-not-allowed disabled:select-none resize-y
        '
    ]) }}
></textarea>
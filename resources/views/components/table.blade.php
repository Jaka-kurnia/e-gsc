<div class="w-full overflow-x-auto rounded-lg border border-neutral-200 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.05)]">
    <table {{ $attributes->merge(['class' => 'w-full text-left text-sm text-neutral-700 border-collapse']) }}>
        {{ $slot }}
    </table>
</div>

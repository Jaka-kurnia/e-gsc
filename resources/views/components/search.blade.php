@props([
    'placeholder' => 'Cari data...', 
    'name' => 'search', 
    'value' => request('search')
])

<div 
    x-data="{ 
        query: '{{ $value }}',
        clearSearch() {
            this.query = '';
            // Otomatis submit form setelah diclear agar data kembali penuh
            $nextTick(() => { $el.closest('form').submit(); });
        }
    }" 
    class="relative w-full max-w-xs"
>
    <!-- Icon Search (Flaticon) -->
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <i class="fi fi-rr-search text-gray-400 text-base leading-none"></i>
    </div>
    
    <!-- Input Field -->
    <input 
        type="text" 
        name="{{ $name }}" 
        x-model="query"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => '
                block w-full h-10 pl-9 pr-10 text-sm text-neutral-800 bg-white rounded-xl
                placeholder:text-neutral-400 border border-neutral-200 transition-colors duration-150
                focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none
                shadow-[inset_0_1px_1px_rgba(0,0,0,0.075)]
            '
        ]) }}
    >

    <!-- Button Clear (Hanya Muncul Jika Input Ada Isinya) -->
    <button 
        x-show="query.length > 0"
        x-on:click="clearSearch()"
        type="button"
        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors"
        style="display: none;" 
    >
        <i class="fi fi-rr-cross-small text-lg leading-none"></i>
    </button>
</div>
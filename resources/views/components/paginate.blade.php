{{-- resources/views/components/paginate.blade.php --}}
@props(['paginator'])

@php
    // Mengambil element halaman secara otomatis dari instance paginator Laravel
    $elements = $paginator->render()->elements;
@endphp

@if ($paginator->hasPages())
    <div class="flex items-center justify-between w-full h-16 px-3 border-t border-neutral-200">
        <p class="pl-2 text-sm text-gray-700">
            Showing
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-medium">{{ $paginator->total() }}</span>
            results
        </p>

        <nav role="navigation" aria-label="Pagination Navigation">
            <ul class="flex items-center text-sm leading-tight bg-white border border-neutral-200/70 rounded h-8.5 text-neutral-500">

                {{-- Tombol Previous --}}
                <li class="h-full">
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center h-full px-3 rounded-l bg-neutral-50 text-neutral-400 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center h-full px-3 rounded-l group hover:bg-blue-600 hover:text-white transition-colors">
                            Previous
                        </a>
                    @endif
                </li>

                {{-- Elemen Nomor Halaman --}}
                @foreach ($elements as $element)
                    {{-- Berupa Tiga Titik (...) Pemisah --}}
                    @if (is_string($element))
                        <li class="hidden h-full md:block">
                            <div class="relative inline-flex items-center h-full px-2.5 bg-neutral-100 group">
                                <span>{{ $element }}</span>
                            </div>
                        </li>
                    @endif

                    {{-- Berupa Array Link Nomor Halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- Halaman Aktif --}}
                                <li class="hidden h-full md:block">
                                    <span class="relative inline-flex items-center h-full px-3 text-white bg-blue-600 font-medium">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                {{-- Halaman Lain --}}
                                <li class="hidden h-full md:block">
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center h-full px-3 group hover:bg-blue-600 hover:text-white transition-colors">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                <li class="h-full">
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center h-full px-3 rounded-r group hover:bg-blue-600 hover:text-white transition-colors">
                            Next
                        </a>
                    @else
                        <span class="relative inline-flex items-center h-full px-3 rounded-r bg-neutral-50 text-neutral-400 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </li>

            </ul>
        </nav>
    </div>
@endif
{{-- resources/views/components/paginate.blade.php --}}
@props(['paginator'])

@php
    // Ambil element halaman secara aman, jika tidak dikirim dari links() kita buat range sederhana
    $elements = $elements ?? [ $paginator->getUrlRange(max(1, $paginator->currentPage() - 3), min($paginator->lastPage(), $paginator->currentPage() + 3)) ];
@endphp

@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between w-full gap-4 py-4 px-4 border-t border-neutral-200">
        {{-- Bagian Kiri: Info Teks Hasil --}}
        <p class="text-sm text-neutral-600 font-normal">
            Showing
            <span class="font-semibold text-neutral-800">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-semibold text-neutral-800">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-semibold text-neutral-800">{{ $paginator->total() }}</span>
            results
        </p>

        {{-- Bagian Kanan: Kontrol Menu Navigasi Angka --}}
        <nav role="navigation" aria-label="Pagination Navigation">
            <ul class="flex items-center gap-1.5 text-sm font-medium">

                {{-- Tombol Previous --}}
                <li>
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex items-center justify-center h-8.5 px-3 rounded border border-neutral-200 bg-neutral-50 text-neutral-400 cursor-not-allowed select-none">
                            Previous
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="inline-flex items-center justify-center h-8.5 px-3 rounded border border-neutral-200 bg-white text-neutral-600 hover:bg-neutral-50 hover:text-blue-600 active:bg-neutral-100 transition-colors shadow-sm">
                            Previous
                        </a>
                    @endif
                </li>

                {{-- Elemen Nomor Halaman --}}
                @foreach ($elements as $element)
                    {{-- Berupa Tiga Titik (...) Pemisah --}}
                    @if (is_string($element))
                        <li class="hidden md:block">
                            <div class="inline-flex items-center justify-center h-8.5 w-8.5 text-neutral-400">
                                <span>{{ $element }}</span>
                            </div>
                        </li>
                    @endif

                    {{-- Berupa Array Link Nomor Halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- Halaman Aktif --}}
                                <li class="hidden md:block">
                                    <span class="inline-flex items-center justify-center h-8.5 min-w-8.5 px-2.5 rounded text-white bg-blue-600 font-semibold shadow-sm shadow-blue-500/10">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                {{-- Halaman Lain --}}
                                <li class="hidden md:block">
                                    <a href="{{ $url }}"
                                        class="inline-flex items-center justify-center h-8.5 min-w-8.5 px-2.5 rounded border border-neutral-200 bg-white text-neutral-600 hover:bg-neutral-50 hover:text-blue-600 transition-colors shadow-sm">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                <li>
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="inline-flex items-center justify-center h-8.5 px-3 rounded border border-neutral-200 bg-white text-neutral-600 hover:bg-neutral-50 hover:text-blue-600 active:bg-neutral-100 transition-colors shadow-sm">
                            Next
                        </a>
                    @else
                        <span class="inline-flex items-center justify-center h-8.5 px-3 rounded border border-neutral-200 bg-neutral-50 text-neutral-400 cursor-not-allowed select-none">
                            Next
                        </span>
                    @endif
                </li>

            </ul>
        </nav>
    </div>
@endif
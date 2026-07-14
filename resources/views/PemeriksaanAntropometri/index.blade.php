<x-app-layout>
    <x-slot name="title">Pemeriksaan Antropometri</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemeriksaan Antropometri') }}
        </h2>
        <x-btn-primary type="button" x-data x-on:click="$dispatch('open-add-modal')"
            class="px-4 py-2 flex items-center gap-2">
            <i class="fi fi-rr-plus"></i>
            Tambah Data
        </x-btn-primary>
    </x-slot>

    <div x-data="pemeriksaanAntropometriForm()" x-on:open-add-modal.window="openAddModal()"
        x-on:open-edit-modal.window="openEditModal($event.detail)" class="py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari No. Pemeriksaan atau Nama Anak..." />
            </form>

            <div class="flex justify-end gap-2">
                <x-btn-success class="p-0! overflow-hidden shadow-sm">
                    <a href="{{ route('pemeriksaan_antropometri.excel', request()->query()) }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                        <i class="fi fi-rr-file-excel text-base leading-none"></i>
                        <span>Export Excel</span>
                    </a>
                </x-btn-success>

                <x-btn-danger class="p-0! overflow-hidden shadow-sm">
                    <a href="{{ route('pemeriksaan_antropometri.pdf', request()->query()) }}" target="_blank"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                        <i class="fi fi-rr-file-pdf text-base leading-none"></i>
                        <span>Export PDF</span>
                    </a>
                </x-btn-danger>
            </div>
        </div>

        <x-table>
            <thead>
                <tr>
                    <x-th class="text-center w-12">No</x-th>
                    <x-th>No. Pemeriksaan</x-th>
                    <x-th>Nama Anak</x-th>
                    <x-th class="text-center">Berat Badan</x-th>
                    <x-th class="text-center">Tinggi Badan</x-th>
                    {{-- <x-th class="text-center">Lingkar Kepala</x-th> --}}
                    <x-th class="text-center">Status Gizi</x-th>
                    <x-th class="text-center">Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemeriksaanAntropometri as $item)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $item->pemeriksaan->nomor_pemeriksaan ?? '-' }}</x-td>
                        <x-td>{{ $item->pemeriksaan->anak->nama ?? '-' }}</x-td>
                        <x-td class="text-center">{{ $item->berat_badan }} kg</x-td>
                        <x-td class="text-center">{{ $item->tinggi_badan }} cm</x-td>
                        {{-- <x-td class="text-center">{{ $item->lingkar_kepala ? $item->lingkar_kepala . ' cm' : '-' }}</x-td> --}}
                        <x-td class="text-center">
                            @php
                                $badgeClass = match ($item->status_gizi) {
                                    'normal' => 'text-white bg-green-700',
                                    'gizi_kurang'=> 'text-white bg-amber-500', 
                                    'gizi_lebih' => 'text-white bg-yellow-600',
                                    'gizi_buruk' => 'text-white bg-red-800',
                                };
                            @endphp
                            <span
                                class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                {{ ucwords(str_replace('_', ' ', $item->status_gizi)) }}
                            </span>
                        </x-td>

                        <x-td class="text-center">
                            <div class="flex justify-center items-center gap-1.5">
                                <x-btn-primary type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm" title="Detail"
                                    x-on:click="$dispatch('open-detail-modal', {
                                     nomor_pemeriksaan: '{{ $item->pemeriksaan->nomor_pemeriksaan ?? '-' }}',
                                     nama_anak: '{{ $item->pemeriksaan->anak->nama ?? '-' }}',
                                     berat_badan: '{{ $item->berat_badan }} kg',
                                     tinggi_badan: '{{ $item->tinggi_badan }} cm',
                                     lingkar_kepala: '{{ $item->lingkar_kepala ? $item->lingkar_kepala . ' cm' : '-' }}',
                                     tren_pertumbuhan: '{{ $item->tren_pertumbuhan }}',
                                     status_gizi: '{{ ucwords(str_replace('_', ' ', $item->status_gizi)) }}'
                             })">
                                    <i class="fi fi-rr-eye text-base leading-none"></i>
                                </x-btn-primary>

                                <x-btn-edit type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm" title="Edit Data"
                                    x-on:click="$dispatch('open-edit-modal', {{ json_encode($item) }})">
                                    <i class="fi fi-rr-edit text-base leading-none"></i>
                                </x-btn-edit>

                                <form action="{{ route('pemeriksaan_antropometri.destroy', $item->pemeriksaan_id) }}"
                                    method="POST" id="delete-form-{{ $item->pemeriksaan_id }}"
                                    class="inline-block m-0">
                                    @csrf
                                    @method('DELETE')
                                    <x-btn-delete type="button"
                                        class="w-9 h-9 p-0! flex items-center justify-center shadow-sm"
                                        onclick="confirmDelete('{{ $item->pemeriksaan_id }}')" title="Hapus Data">
                                        <i class="fi fi-rr-trash text-base leading-none"></i>
                                    </x-btn-delete>
                                </form>
                            </div>
                        </x-td>
                    </tr>
                @empty
                    <tr>
                        <x-td colspan="8" class="text-center p-0">
                            <div class="flex items-center justify-center py-10 w-full">
                                @if (request('search'))
                                    <span
                                        class="text-sm text-white bg-red-700 font-semibold px-4 py-2.5 rounded-lg flex items-center justify-center gap-2 border border-amber-200 shadow-sm mx-auto">
                                        <i class="fi fi-rr-search-alt text-lg leading-none"></i>
                                        <span>Data dengan kata kunci "{{ request('search') }}" tidak ditemukan</span>
                                    </span>
                                @else
                                    <span
                                        class="text-sm text-white bg-red-700 font-semibold px-4 py-2.5 rounded-lg flex items-center justify-center gap-2 border border-red-200 shadow-sm mx-auto">
                                        <i class="fi fi-rr-file-exclamation text-lg leading-none"></i>
                                        <span>Data Pemeriksaan Antropometri Belum Tersedia</span>
                                    </span>
                                @endif
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
        <x-paginate :paginator="$pemeriksaanAntropometri" />

        @include('PemeriksaanAntropometri.detail')
        @include('PemeriksaanAntropometri.modalTambah')
    </div>

    @include('PemeriksaanAntropometri.script')
</x-app-layout>

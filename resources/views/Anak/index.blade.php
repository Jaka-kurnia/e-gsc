<x-app-layout>
    <!-- Slot untuk Judul di Tab Browser -->
    <x-slot name="title">Data Anak</x-slot>

    <!-- Slot untuk Header di dalam Halaman -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Anak') }}
        </h2>
        <x-btn-primary type="button" x-data x-on:click="$dispatch('open-add-modal')"
            class="px-4 py-2 flex items-center gap-2">
            <i class="fi fi-rr-plus"></i>
            Tambah Data
        </x-btn-primary>
    </x-slot>

    <div x-data="anakForm()" x-on:open-add-modal.window="openAddModal()"
        x-on:open-edit-modal.window="openEditModal($event.detail)" class="py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <!-- Form Search -->
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari NIK atau Nama..." />
            </form>

            <div class="flex justify-end gap-2">
                <x-btn-success class="p-0! overflow-hidden shadow-sm">
                    <a href="{{ route('anak.excel', request()->query()) }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                        <i class="fi fi-rr-file-excel text-base leading-none"></i>
                        <span>Export Excel</span>
                    </a>
                </x-btn-success>

                <x-btn-danger class="p-0! overflow-hidden shadow-sm">
                    <a href="{{ route('anak.pdf', request()->query()) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
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
                    <x-th>NIK</x-th>
                    <x-th>Nama Anak</x-th>
                    <x-th class="text-center">Jenis Kelamin</x-th>
                    <x-th class="text-center">Berat Badan</x-th>
                    <x-th class="text-center">Tinggi Badan</x-th>
                    <x-th class="text-center">Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anak as $item)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $item->nik }}</x-td>
                        <x-td>{{ $item->nama }}</x-td>
                        <x-td class="text-center">
                            {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </x-td>
                        <x-td class="text-center">{{ $item->berat_badan }} kg</x-td>
                        <x-td class="text-center">{{ $item->tinggi_badan }} cm</x-td>

                        <x-td class="text-center">
                            <div class="flex justify-center items-center gap-1.5">
                                <x-btn-primary type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm" title="Detail Anak"
                                    x-on:click="$dispatch('open-detail-modal', {
                                     nik: '{{ $item->nik }}',
                                     nama: '{{ $item->nama }}',
                                     nama_orang_tua: '{{ $item->ibu->nama_ibu ?? '-' }}',
                                     tanggal_lahir: '{{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}',
                                     jenis_kelamin: '{{ $item->jenis_kelamin }}',
                                     berat_badan: '{{ $item->berat_badan }} kg',
                                     tinggi_badan: '{{ $item->tinggi_badan }} cm'
                             })">
                                    <i class="fi fi-rr-eye text-base leading-none"></i>
                                </x-btn-primary>

                                <x-btn-edit type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm" title="Edit Data"
                                    x-on:click="$dispatch('open-edit-modal', {{ json_encode($item) }})">
                                    <i class="fi fi-rr-edit text-base leading-none"></i>
                                </x-btn-edit>

                                <form action="{{ route('anak.destroy', $item->id) }}" method="POST"
                                    id="delete-form-{{ $item->id }}" class="inline-block m-0">
                                    @csrf
                                    @method('DELETE')
                                    <x-btn-delete type="button"
                                        class="w-9 h-9 p-0! flex items-center justify-center shadow-sm"
                                        onclick="confirmDelete('{{ $item->id }}')" title="Hapus Data">
                                        <i class="fi fi-rr-trash text-base leading-none"></i>
                                    </x-btn-delete>
                                </form>
                            </div>
                        </x-td>
                    </tr>
                @empty
                    <tr>
                        <x-td colspan="9" class="text-center p-0">
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
                                        <span>Data Anak Belum Tersedia</span>
                                    </span>
                                @endif
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
        <x-paginate :paginator="$anak" />

        @include('Anak.detail')
        @include('Anak.modalTambah')
    </div>

    @include('Anak.script')
</x-app-layout>

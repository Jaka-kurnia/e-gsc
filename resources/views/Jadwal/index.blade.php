<x-app-layout>
    <x-slot name="title">Data Jadwal</x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jadwal') }}
        </h2>
        <x-btn-primary x-data x-on:click="$dispatch('open-add-modal')" class="px-4 py-2 flex items-center gap-2">
            <i class="fi fi-rr-plus"></i>
            Tambah Data
        </x-btn-primary>
    </x-slot>

    <div x-data="jadwalForm()" x-on:open-add-modal.window="openAddModal()"
        x-on:open-edit-modal.window="openEditModal($event.detail)" class="py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <!-- Form Search -->
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari Nama Kegiatan..." x-model="search" />
            </form>

            <div class="flex justify-end gap-2">
                <x-btn-success class="p-0! overflow-hidden shadow-sm">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                        <i class="fi fi-rr-file-excel text-base leading-none"></i>
                        <span>Export Excel</span>
                    </a>
                </x-btn-success>

                <x-btn-danger class="p-0! overflow-hidden shadow-sm">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                        <i class="fi fi-rr-file-pdf text-base leading-none"></i>
                        <span>Export PDF</span>
                    </a>
                </x-btn-danger>
            </div>
        </div>

        <x-table>
            <thead>
                <tr>
                    <x-th class="text-center">No</x-th>
                    <x-th>Nama Kegiatan</x-th>
                    <x-th>Tanggal Kegiatan</x-th>
                    <x-th>Status Logistik</x-th>
                    <x-th>Catatan</x-th>
                    <x-th class="text-center">Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwal as $item)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $item->nama_kegiatan }}</x-td>
                        <x-td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') }}</x-td>
                        <x-td>
                            @if ($item->status_logistik == 'Siap')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fi fi-rr-checkbox text-xs leading-none"></i>
                                    {{ $item->status_logistik }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fi fi-rr-time-past text-xs leading-none"></i>
                                    {{ $item->status_logistik }}
                                </span>
                            @endif
                        </x-td>
                        <x-td>
                            <div class="max-w-40 truncate" title="{{ $item->catatan }}">
                                {{ $item->catatan ?? '-' }}
                            </div>
                        </x-td>
                        <x-td class="text-center">
                            <div class="flex justify-center items-center gap-1.5">
                                <x-btn-primary type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm"
                                    title="Detail Jadwal"
                                    x-on:click="$dispatch('open-detail-modal', {
                                    nama_kegiatan: '{{ $item->nama_kegiatan }}',
                                    tanggal_kegiatan: '{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') }}',
                                    status_logistik: '{{ $item->status_logistik }}',
                                    catatan: '{{ $item->catatan ?? '-' }}'
                                })">
                                    <i class="fi fi-rr-eye text-base leading-none"></i>
                                </x-btn-primary>

                                <x-btn-edit type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm"
                                    x-on:click="$dispatch('open-edit-modal', {{ json_encode($item) }})">
                                    <i class="fi fi-rr-edit text-base leading-none"></i>
                                </x-btn-edit>

                                <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST"
                                    id="delete-form-{{ $item->id }}" class="m-0 inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-btn-delete type="button"
                                        class="w-9 h-9 p-0! flex items-center justify-center shadow-sm"
                                        onclick="confirmDelete('{{ $item->id }}')">
                                        <i class="fi fi-rr-trash text-base leading-none"></i>
                                    </x-btn-delete>
                                </form>
                            </div>
                        </x-td>
                    </tr>
                @empty
                    <tr>
                        <x-td colspan="6" class="text-center p-0">
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
                                        <span>Data Jadwal Belum Tersedia</span>
                                    </span>
                                @endif
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>

        </x-table>

        <x-paginate :paginator="$jadwal" />

        {{-- Modal Tambah / Edit Data --}}
        @include('Jadwal.modalTambah')
    </div>
    @include('Jadwal.detail')

    <!-- Script Alpine.js & SweetAlert2 -->
    @include('Jadwal.script')
</x-app-layout>

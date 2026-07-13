<x-app-layout>
    <x-slot name="title">Data Pemeriksaan</x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemeriksaan') }}
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
                    <a href="#" target="_blank"
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
                    <x-th class="text-center">No</x-th>
                    <x-th>Nomor Antrean</x-th>
                    <x-th>Nama Anak</x-th>
                    <x-th>Metode Kunjungan</x-th>
                    <x-th>Tanggal Kunjungan</x-th>
                    <x-th class="text-center">Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemeriksaan as $item)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $item->nomor_antri }}</x-td>
                        <x-td>{{ $item->anak->nama }}</x-td>
                        <x-td>
                            {{ $item->metode_kunjungan === 'hari_h' ? 'Hari H' : 'Sweeping' }}
                        </x-td>
                        <x-td>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d F Y') }}</x-td>

                        <x-td class="text-center">
                            <div class="flex justify-center items-center gap-1.5">
                                <x-btn-primary type="button"
                                    class="w-9 h-9 p-0! flex items-center justify-center shadow-sm"
                                    title="Detail Pemeriksaan"
                                    x-on:click="$dispatch('open-detail-modal', {
                                    nomor_pemeriksaan: '{{ $item->nomor_pemeriksaan }}',
                                    nomor_antri: '{{ $item->nomor_antri }}',
                                    metode_kunjungan: '{{ $item->metode_kunjungan === 'hari_h' ? 'Hari H' : 'Sweeping' }}',
                                    tanggal_kunjungan: '{{ $item->tanggal_kunjungan->translatedFormat('d F Y') }}',
                                    umur_bulan: '{{ $item->umur_bulan }} Bulan',
                                    approvel_status: '{{ $item->approvel_status }}',
        
                                    // Relasi Eager Loading (Pastikan nama relasi ini sesuai di Controller)
                                    nama_anak: '{{ $item->anak->nama_anak ?? '-' }}',
                                    nama_kegiatan: '{{ $item->jadwal->nama_kegiatan ?? '-' }}',
                                    penginput: '{{ $item->user->name ?? '-' }}',
                                    verifikator: '{{ $item->approvedBy->name ?? 'Belum Diverifikasi' }}'
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
                                        <span>Data Pemeriksaan Belum Tersedia</span>
                                    </span>
                                @endif
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>

        </x-table>

        <x-paginate :paginator="$pemeriksaan" />

        @include('Pemeriksaan.detail')
        @include('Pemeriksaan.modalTambah')
        @include('Pemeriksaan.script')


</x-app-layout>

<x-app-layout>
    <x-slot name="title">Data Ibu</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Orang Anak') }}
        </h2>
        <x-btn-primary x-data x-on:click="$dispatch('open-add-modal')" class="px-4 py-2 flex items-center gap-2">
            <i class="fi fi-rr-plus"></i>
            Tambah Data
        </x-btn-primary>
    </x-slot>

    <div x-data="ibuForm()" x-on:open-add-modal.window="openAddModal()"
        x-on:open-edit-modal.window="openEditModal($event.detail)" class="py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <!-- Form Search -->
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari  NIK atau Nama..." x-model="search" />
            </form>

            <div class="flex justify-end gap-1.5 mb-6">
                <x-btn-success>
                    <a href="#">
                        <i class="fi fi-rr-file-excel mx-2 text-xl"></i>
                        Export Excel
                    </a>
                </x-btn-success>

                <x-btn-danger>
                    <a href="#">
                        <i class="fi fi-rr-file-pdf mx-2 text-xl"></i>
                        Export PDF
                    </a>
                </x-btn-danger>
            </div>
        </div>

        <x-table>
            <thead>
                <tr>
                    <x-th class="text-center">No</x-th>
                    <x-th>NIK</x-th>
                    <x-th>Nama </x-th>
                    <x-th>Orang Tua</x-th>
                    <x-th>Tanggal Lahir</x-th>
                    <x-th>Jenis Kelamin</x-th>
                    <x-th>Berat Badan</x-th>
                    <x-th>Tinggi Badan</x-th>
                    <x-th>Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anak as $item)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $item->nik }}</x-td>
                        <x-td>{{ $item->nama }}</x-td>
                        <x-td>{{ $item->ibu->nama_ibu }}</x-td>
                        <x-td class="text-center">{{ $item->tanggal_lahir }}</x-td>
                        <x-td class="text-center">
                            {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </x-td>
                        <x-td class="text-center">{{ $item->berat_badan }}</x-td>
                        <x-td class="text-center">{{ $item->tinggi_badan }}</x-td>
                        <x-td class="text-center">
                            <div class="flex justify-center gap-2">
                                <x-btn-warning>
                                    <a href="{{ route('anak.edit', $item->id) }}">
                                        <i class="fi fi-rr-edit"></i>
                                    </a>
                                </x-btn-warning>
                                <x-btn-delete type="button" onclick="confirmDelete('{{ $item->id }}')">
                                    <i class="fi fi-rr-trash text-lg"></i>
                                </x-btn-delete>
                            </div>
                        </x-td>
                    </tr>

                @empty
                    <tr>
                        <x-td colspan="9">
                            <div class="flex items-center justify-center">
                                <span
                                    class="text-md text-red-800 bg-white font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                                    <i class="fi fi-rr-file-exclamation text-xl"></i>
                                    Data Anak Belum Tersedia
                                </span>
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>

        </x-table>
        {{-- Akhir  --}}
    </div>
</x-app-layout>

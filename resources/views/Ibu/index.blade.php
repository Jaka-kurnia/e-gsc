<x-app-layout>
    <!-- Slot untuk Judul di Tab Browser -->
    <x-slot name="title">Data Ibu</x-slot>

    <!-- Slot untuk Header di dalam Halaman -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Orang Tua') }}
        </h2>
        <x-btn-primary x-data x-on:click="$dispatch('open-modal', 'modal_ibu')" class="px-4 py-2 flex items-center gap-2">
            <i class="fi fi-rr-plus"></i>
            Tambah Data
        </x-btn-primary>
    </x-slot>

    <div class="py-6">

        <div class="flex justify-end gap-1.5 mb-6">
            <x-btn-success>
                <a href="#">
                    <i class="fi fi-rr-file-excel mx-2"></i>
                    Export Excel
                </a>
            </x-btn-success>

            <x-btn-danger>
                <a href="#">
                    <i class="fi fi-rr-file-pdf mx-2"></i>
                    Export PDF
                </a>
            </x-btn-danger>
        </div>

        <x-table>
            <thead>
                <tr>
                    <x-th class="text-center">No</x-th>
                    <x-th>NIK</x-th>
                    <x-th>Nama Ibu</x-th>
                    <x-th>Nama Ayah</x-th>
                    <x-th>RW</x-th>
                    <x-th>RT</x-th>
                    <x-th>Alamat</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ibu as $iterm)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $iterm->nik }}</x-td>
                        <x-td>{{ $iterm->nama_ibu }}</x-td>
                        <x-td>{{ $iterm->nama_ayah }}</x-td>
                        <x-td>{{ $iterm->rw }}</x-td>
                        <x-td>{{ $iterm->rt }}</x-td>
                        <x-td>{{ $iterm->alamat }}</x-td>
                    </tr>
                @empty
                    <tr>
                        <x-td colspan="7">
                            <div class="flex items-center justify-center">
                                <span class="text-md text-red-700 bg-white">
                                    <i class="fi fi-rr-file-exclamation text-xl"></i>
                                    Data Orang Tua Belum Tersedia
                                </span>
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>

    {{-- Modal Tambah Data  --}}
    <x-modal name="modal_ibu">
        <div class="p-6">
            <!-- Judul Modal (Estetika Tabler) -->
            <div class="mb-5">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Data Orang Tua</h3>
            </div>

            <form action="{{ route('ibu.store') }}" method="POST">
                @csrf

                <!-- Grid Input Fields -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <x-input label="NIK" name="nik" placeholder="Masukkan NIK" />
                    <x-input label="Nama Ibu" name="nama_ibu" placeholder="Masukkan Nama Ibu" />
                    <x-input label="Nama Ayah" name="nama_ayah" placeholder="Masukkan Nama Ayah" />
                    <x-input label="RT" name="rt" placeholder="Masukkan RT" />
                    <x-input label="RW" name="rw" placeholder="Masukkan RW" />
                    <x-input label="Alamat" name="alamat" placeholder="Masukkan Alamat" />
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-btn-danger type="button" x-data x-on:click="$dispatch('close-modal', 'modal_ibu')"
                        class="px-4 py-2 text-sm font-medium">
                        Batal
                    </x-btn-danger>
                    <x-btn-primary type="" class="px-4 py-2 text-sm font-medium shadow-sm">
                        Simpan Data
                    </x-btn-primary>
                </div>
            </form>
        </div>
    </x-modal>

</x-app-layout>

<x-app-layout>
    <x-slot name="title">Pemeriksaan Konseling</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemeriksaan Konseling') }}
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
                    <a href="#"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
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
                    <x-th class="text-center w-12">No</x-th>
                    <x-th>Catatan Konseling</x-th>
                    <x-th>Pemberian PMT</x-th>
                    <x-th class="text-center">Aksi</x-th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </x-table>
        {{-- <x-paginate :paginator="$pemeriksaanAntropometri" /> --}}


    </div>

 
</x-app-layout>

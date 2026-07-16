<x-app-layout>
    <x-slot name="title">Data Jadwal</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jadwal') }}
        </h2>
        <div class="flex items-center gap-2">
            <x-btn-success class="p-0! overflow-hidden shadow-sm">
                <a href="{{ route('jadwal.excel', request()->query()) }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                    <i class="fi fi-rr-file-excel text-base leading-none"></i>
                    <span>Excel</span>
                </a>
            </x-btn-success>
            <x-btn-danger class="p-0! overflow-hidden shadow-sm">
                <a href="{{ route('jadwal.pdf', request()->query()) }}" target="_blank"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium h-full w-full">
                    <i class="fi fi-rr-file-pdf text-base leading-none"></i>
                    <span>PDF</span>
                </a>
            </x-btn-danger>
            <x-btn-primary x-data x-on:click="$dispatch('open-add-modal')" class="px-4 py-2 flex items-center gap-2">
                <i class="fi fi-rr-plus"></i>
                Tambah Data
            </x-btn-primary>
        </div>
    </x-slot>

    <div x-data="jadwalCalendar()" x-on:open-add-modal.window="openAddModal()"
        x-on:open-edit-modal.window="openEditModal($event.detail)" class="py-6">

        <!-- Search -->
        <div class="mb-6">
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari Nama Kegiatan..." />
            </form>
        </div>

        <!-- Calendar Header -->
        <div
            class="flex items-center justify-between bg-white rounded-t-xl border border-neutral-200 px-6 py-4 shadow-sm">
            <button type="button" x-on:click="prevMonth()"
                class="flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                <i class="fi fi-rr-angle-left text-base leading-none"></i>
                <span class="hidden sm:inline">Sebelumnya</span>
            </button>

            <h3 class="text-lg font-bold text-gray-800 select-none" x-text="bulanTahun"></h3>

            <button type="button" x-on:click="nextMonth()"
                class="flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                <span class="hidden sm:inline">Berikutnya</span>
                <i class="fi fi-rr-angle-right text-base leading-none"></i>
            </button>
        </div>

        <!-- Calendar Grid -->
        <div class="bg-white border-x border-b border-neutral-200 rounded-b-xl shadow-sm overflow-hidden">
            <!-- Day Names -->
            <div class="grid grid-cols-7 border-b border-neutral-200">
                <template x-for="day in hari" :key="day">
                    <div class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider bg-neutral-50"
                        x-text="day">
                    </div>
                </template>
            </div>

            <!-- Date Cells -->
            <template x-for="(week, wi) in minggu" :key="wi">
                <div class="grid grid-cols-7 border-b border-neutral-100 last:border-b-0">
                    <template x-for="(cell, ci) in week" :key="ci">
                        <div class="min-h-25 sm:min-h-30 p-1.5 border-r border-neutral-100 last:border-r-0 relative transition-colors duration-150"
                            x-bind:class="{
                                'bg-white hover:bg-blue-50/50 cursor-pointer': cell.date,
                                'bg-neutral-50/50': !cell.date,
                                'ring-2 ring-blue-400 ring-inset': cell.isToday
                            }"
                            x-on:click="cell.date && clickDate(cell.dateStr)"
                            x-on:dragover.prevent="cell.date && (dragOver = true)" x-on:dragleave="dragOver = false"
                            x-on:drop.prevent="cell.date && dropOnDate($event, cell.dateStr)">

                            <!-- Date Number -->
                            <template x-if="cell.date">
                                <div class="text-xs font-semibold mb-1 select-none"
                                    x-bind:class="cell.isToday ?
                                        'bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center' :
                                        'text-gray-600'"
                                    x-text="cell.date">
                                </div>
                            </template>

                            <!-- Event Chips -->
                            <template x-for="event in cell.events" :key="event.id">
                                <div draggable="true" x-on:click.stop="editEvent(event)"
                                    x-on:dragstart="dragStart($event, event)" x-on:dragend="dragEnd()"
                                    class="text-xs px-1.5 py-0.5 mb-0.5 rounded cursor-grab active:cursor-grabbing truncate transition-shadow hover:shadow-md"
                                    x-bind:class="event.status_logistik === 'Siap' ?
                                        'bg-blue-100 text-blue-800 border-l-2 border-blue-600' :
                                        'bg-red-100 text-red-800 border-l-2 border-red-600'"
                                    x-text="event.nama_kegiatan">
                                </div>
                            </template>

                            <!-- Drop indicator -->
                            <div x-show="dragOver && cell.date"
                                class="absolute inset-0 bg-blue-100/50 border-2 border-dashed border-blue-400 rounded pointer-events-none">
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <!-- Legend -->
        <div class="mt-4 flex items-center gap-4 text-xs text-gray-500">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded bg-blue-100 border-l-2 border-blue-600 block"></span>
                Logistik Siap
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded bg-red-100 border-l-2 border-red-600 block"></span>
                Logistik Belum Siap
            </div>
            <div class="flex items-center gap-1.5">
                <span
                    class="w-3 h-3 rounded bg-blue-600 text-white text-[8px] flex items-center justify-center font-bold">H</span>
                Hari Ini
            </div>
        </div>

        <!-- Modals -->
        @include('Jadwal.modalTambah')
        @include('Jadwal.detail')
    </div>

    @include('Jadwal.script')
</x-app-layout>

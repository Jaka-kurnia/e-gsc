<div x-data="jadwalDetail()" x-on:open-detail-modal.window="openDetail($event.detail)">
    <x-modal name="modal_detail_jadwal">

        <div class="p-6 text-gray-800">
            <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Detail Data Jadwal</h3>
            </div>

            <div class="flex flex-col gap-y-3.5 text-sm">
                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nama Kegiatan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nama_kegiatan || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Tanggal Kegiatan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.tanggal_kegiatan || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Status Logistik</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.status_logistik || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Catatan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.catatan || '-'"></div>
                </div>
            </div>

            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_jadwal')">
                    Tutup
                </x-btn-secondary>
            </div>
        </div>
    </x-modal>
</div>

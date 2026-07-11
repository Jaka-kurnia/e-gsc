<div x-data="imunisasiDetail()" x-on:open-detail-modal.window="openDetail($event.detail)">
    <x-modal name="modal_detail_imunisasi">
        <div class="p-6 text-gray-800">
            <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Detail Data Imunisasi</h3>
            </div>
            <div class="flex flex-col gap-y-3.5 text-sm">
                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Kode Imunisasi</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900 font-semibold" x-text="detail.kode_imunisasi || '-'"></div>
                </div>
                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nama Imunisasi</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nama_imunisasi || '-'"></div>
                </div>
                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Deskripsi</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.deskripsi || '-'"></div>
                </div>
            </div>
            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_imunisasi')">
                    Tutup
                </x-btn-secondary>
            </div>
        </div>
    </x-modal>
</div>
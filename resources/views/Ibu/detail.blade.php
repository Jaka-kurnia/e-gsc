<div x-data="ibuDetail()" x-on:open-detail-modal.window="openDetail($event.detail)">
    <x-modal name="modal_detail_ibu">

        <div class="p-6 text-gray-800">
            <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Detail Data Orang Tua</h3>
            </div>

            <div class="flex flex-col gap-y-3.5 text-sm">
                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">NIK</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900 font-semibold" x-text="detail.nik || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nama Ibu</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nama_ibu || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nama Ayah</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nama_ayah || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">No. HP</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.no_hp || '-'"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">RT / RW</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="(detail.rt || '-') + ' / ' + (detail.rw || '-')"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Alamat</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.alamat || '-'"></div>
                </div>
            </div>

            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_ibu')">
                    Tutup
                </x-btn-secondary>
            </div>
        </div>
    </x-modal>
</div>

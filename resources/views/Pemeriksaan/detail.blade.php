<div x-data="pemeriksaanDetail()" x-on:open-detail-modal.window="openDetail($event.detail)">
    <x-modal name="modal_detail_pemeriksaan">
        <div class="p-6 text-gray-800">
            <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Detail Pemeriksaan</h3>
            </div>

            <div class="flex flex-col gap-y-3.5 text-sm">
                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nomor Pemeriksaan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900 font-semibold" x-text="detail.nomor_pemeriksaan"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nomor Antrean</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nomor_antri"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nama Anak</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nama_anak"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Nama Kegiatan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.nama_kegiatan"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Metode Kunjungan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.metode_kunjungan"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Tanggal Kunjungan</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.tanggal_kunjungan"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Umur (Bulan)</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.umur_bulan"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Status</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.approvel_status"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Penginput</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.penginput"></div>
                </div>

                <div class="flex items-start">
                    <div class="w-36 text-gray-500 font-medium shrink-0">Verifikator</div>
                    <div class="px-2 text-gray-500">:</div>
                    <div class="text-gray-900" x-text="detail.verifikator"></div>
                </div>
            </div>

            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_pemeriksaan')">
                    Tutup
                </x-btn-secondary>
            </div>
        </div>
    </x-modal>
</div>
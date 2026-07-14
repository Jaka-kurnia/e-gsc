<div x-data="pemeriksaanAntropometriDetail()" x-on:open-detail-modal.window="openDetail($event.detail)">
 <x-modal name="modal_detail_pemeriksaan_antropometri">
     <div class="p-6 text-gray-800">
         <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
             <h3 class="text-lg font-semibold text-gray-900">Detail Pemeriksaan Antropometri</h3>
         </div>

         <div class="flex flex-col gap-y-3.5 text-sm">

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">No. Pemeriksaan</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900 font-semibold" x-text="detail.nomor_pemeriksaan"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Nama Anak</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.nama_anak"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Berat Badan</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.berat_badan"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Tinggi Badan</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.tinggi_badan"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Lingkar Kepala</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.lingkar_kepala"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Tren Pertumbuhan</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.tren_pertumbuhan"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Status Gizi</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.status_gizi"></div>
             </div>
         </div>

         <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
             <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_pemeriksaan_antropometri')">
                 Tutup
             </x-btn-secondary>
         </div>
     </div>
 </x-modal>
</div>

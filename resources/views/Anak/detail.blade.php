 {{-- Modal Detail Data Anak --}}
 <x-modal name="modal_detail_anak">
     <div class="p-6 text-gray-800">
         <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
             <h3 class="text-lg font-semibold text-gray-900">Detail Data Anak</h3>
         </div>

         <div class="flex flex-col gap-y-3.5 text-sm">

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">NIK</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900 font-semibold" x-text="detail.nik"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Nama Anak</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.nama"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Nama Orang Tua</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.nama_orang_tua"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Tanggal Lahir</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.tanggal_lahir"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Jenis Kelamin</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900"
                     x-text="detail.jenis_kelamin === 'L' ? 'Laki-laki' : (detail.jenis_kelamin === 'P' ? 'Perempuan' : '-')">
                 </div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Berat Badan</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.berat_badan + ' kg'"></div>
             </div>

             <div class="flex items-start">
                 <div class="w-36 text-gray-500 font-medium shrink-0">Tinggi Badan</div>
                 <div class="px-2 text-gray-500">:</div>
                 <div class="text-gray-900" x-text="detail.tinggi_badan + ' cm'"></div>
             </div>
         </div>

         <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
             <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_anak')">
                 Tutup
             </x-btn-secondary>
         </div>
     </div>
 </x-modal>

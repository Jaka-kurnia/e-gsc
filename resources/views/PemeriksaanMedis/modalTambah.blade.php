<x-modal name="modal_pemeriksaan_medis">
    <div class="p-6">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Pemeriksaan Medis</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">
            <!-- Asumsi login user: biarkan controller/auth atau hidden input (misal auth) yang tangani atau user_id nullable di database -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Dropdown Pemeriksaan -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pemeriksaan Anak</label>
                    <x-select-input name="pemeriksaan_id" x-model="pemeriksaan_id" class="w-full">
                        <option value="">Pilih Pemeriksaan</option>
                        @foreach ($pemeriksaans as $pemeriksaan)
                            <option value="{{ $pemeriksaan->id }}">
                                {{ $pemeriksaan->nomor_pemeriksaan }} - {{ $pemeriksaan->anak->nama ?? 'N/A' }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('pemeriksaan_id')" class="mt-2" />
                </div>

                <!-- Dropdown Vitamin -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pemberian Vitamin</label>
                    <x-select-input name="pemberian_vitamin" x-model="pemberian_vitamin" class="w-full">
                        <option value="tidak">Tidak</option>
                        <option value="vitamin_a_merah">Vitamin A Merah</option>
                        <option value="vitamin_a_biru">Vitamin A Biru</option>
                    </x-select-input>
                    <x-input-error :messages="$errors->get('pemberian_vitamin')" class="mt-2" />
                </div>

                <!-- Toggle Obat Cacing -->
                <div class="flex flex-col gap-2">
                    <label class="block text-sm font-medium text-gray-700">Pemberian Obat Cacing</label>
                    <label class="inline-flex items-center cursor-pointer w-max">
                        <input type="checkbox" name="pemberian_obat_cacing" x-model="pemberian_obat_cacing" class="sr-only peer" value="1">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-700" x-text="pemberian_obat_cacing ? 'Ya' : 'Tidak'"></span>
                    </label>
                </div>

                <!-- Toggle Rujukan Medis -->
                <div class="flex flex-col gap-2">
                    <label class="block text-sm font-medium text-gray-700">Status Rujukan Medis</label>
                    <label class="inline-flex items-center cursor-pointer w-max">
                        <input type="checkbox" name="status_rujukan_medis" x-model="status_rujukan_medis" class="sr-only peer" value="1">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-700" x-text="status_rujukan_medis ? 'Ya' : 'Tidak'"></span>
                    </label>
                </div>

                <!-- Catatan -->
                <div class="col-span-1 md:col-span-2 mt-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <x-textarea name="catatan" placeholder="Masukkan Catatan Medis (Opsional)" rows="3" x-model="catatan" />
                    <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_pemeriksaan_medis')"
                    class="px-4 py-2 text-sm font-medium">
                    Batal
                </x-btn-danger>
                <x-btn-primary type="submit" class="px-4 py-2 text-sm font-medium shadow-sm">
                    Simpan Data
                </x-btn-primary>
            </div>
        </form>
    </div>
</x-modal>

<x-modal name="modal_jadwal">
    <div class="p-6">
        <!-- Judul Modal -->
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Jadwal</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            <!-- Input Method Spoofing untuk PUT -->
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

            <!-- Grid Input Fields -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                    <x-input name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" x-model="nama_kegiatan" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan</label>
                    <x-date name="tanggal_kegiatan" x-model="tanggal_kegiatan" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Logistik</label>
                    <x-select-input name="status_logistik" x-model="status_logistik">
                        <option value="">Pilih Status Logistik</option>
                        <option value="Belum Siap">Belum Siap</option>
                        <option value="Siap">Siap</option>
                    </x-select-input>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <x-textarea name="catatan" placeholder="Masukkan Catatan (opsional)" rows="3" x-model="catatan" />
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_jadwal')"
                    class="px-4 py-2 text-sm font-medium">
                    Batal
                </x-btn-danger>
                <x-btn-primary type="submit" class="px-4 py-2 text-sm font-medium shadow-sm">
                    Simpan Data
                </x-btn-primary>
            </div>
        </form>

        <!-- Delete form (outside main form to avoid nested form issues) -->
        <div x-show="isEdit" class="mt-4 pt-4 border-t border-gray-100">
            <form x-bind:action="`/jadwal/${editId}`" method="POST"
                x-bind:id="`delete-form-${editId}`" class="inline-block m-0">
                @csrf
                @method('DELETE')
                <x-btn-delete type="button"
                    x-on:click="confirmDelete(editId)"
                    class="w-full px-4 py-2 text-sm font-medium flex items-center justify-center gap-2">
                    <i class="fi fi-rr-trash text-base leading-none"></i>
                    Hapus Data Ini
                </x-btn-delete>
            </form>
        </div>
    </div>
</x-modal>

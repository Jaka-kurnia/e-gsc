<x-modal name="modal_ibu">
    <div class="p-6">
        <!-- Judul Modal -->
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Orang Tua</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            <!-- Input Method Spoofing untuk PUT -->
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

            <!-- Grid Input Fields -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                    <x-input name="nik" placeholder="Masukkan NIK" x-model="nik" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                    <x-input name="nama_ibu" placeholder="Masukkan Nama Ibu" x-model="nama_ibu" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                    <x-input name="nama_ayah" placeholder="Masukkan Nama Ayah" x-model="nama_ayah" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                    <x-input name="no_hp" placeholder="Masukkan No. HP" x-model="no_hp" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                    <x-input name="rt" placeholder="Masukkan RT" x-model="rt" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                    <x-input name="rw" placeholder="Masukkan RW" x-model="rw" />
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <x-textarea name="alamat" placeholder="Masukkan Alamat" rows="3" x-model="alamat" />
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_ibu')"
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

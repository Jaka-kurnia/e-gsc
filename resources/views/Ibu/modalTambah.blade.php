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
                <x-input label="NIK" name="nik" placeholder="Masukkan NIK" x-model="nik" />
                <x-input label="Nama Ibu" name="nama_ibu" placeholder="Masukkan Nama Ibu" x-model="nama_ibu" />
                <x-input label="Nama Ayah" name="nama_ayah" placeholder="Masukkan Nama Ayah" x-model="nama_ayah" />
                <x-input label="No. HP" name="no_hp" placeholder="Masukkan No. HP" x-model="no_hp" />
                <x-input label="RT" name="rt" placeholder="Masukkan RT" x-model="rt" />
                <x-input label="RW" name="rw" placeholder="Masukkan RW" x-model="rw" />
                <div class="col-span-2">
                    <x-textarea label="Alamat" name="alamat" placeholder="Masukkan Alamat" rows="3"
                        x-model="alamat" />
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

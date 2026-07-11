<x-modal name="modal_imunisasi">
    <div class="p-6">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Imunisasi</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            {{-- dinamis triger form edit --}}
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">
            {{-- end --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <x-label value="Kode Imunisasi" />
                    <x-input name="kode_imunisasi" placeholder="Masukkan Kode Imunisasi" x-model="kode_imunisasi" />
                </div>

                <div>
                    <x-label value="Nama Imunisasi" />
                    <x-input name="nama_imunisasi" placeholder="Masukkan Nama Imunisasi" x-model="nama_imunisasi" />
                </div>

                <div class="col-span-2">
                    <x-label value="Deskripsi" />
                    <x-textarea name="deskripsi" placeholder="Masukkan Deskripsi" rows="3"
                        x-model="deskripsi"></x-textarea>
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_imunisasi')"
                    class="px-4 py-2 text-sm font-medium">
                    Batal
                </x-btn-danger>
                <x-btn-primary type="submit" class="px-4 py-2 text-sm font-medium shadow-sm">
                    Simpan Data
                </x-btn-primary>
            </div>
        </form>
</x-modal>
</div>

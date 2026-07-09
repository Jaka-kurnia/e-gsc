<x-modal name="modal_anak">
    <div class="p-6">
        <!-- Judul Modal -->
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Anak</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            <!-- Input Method Spoofing untuk PUT -->
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

            <!-- Grid Input Fields -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <x-input label="NIK" name="nik" placeholder="Masukkan NIK" x-model="nik" />
                <x-input label="Nama Anak" name="nama" placeholder="Masukkan Nama Anak" x-model="nama" />
                <x-select-input label="Ibu" name="ibu_id" x-model="ibu_id" :options="$anak">
                    <option value="" class="uppercase">---- Pilih Ibu ----</option>
                    @foreach ($ibu as $item)
                        <option class="uppercase" value="{{ $item->id }}"
                            {{ old('ibu_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nik }} - {{ $item->nama_ibu }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-date name="tanggal_lahir" x-model="tanggal_lahir" label="Tanggal Lahir"
                    placeholder="Pilih Tanggal Lahir">
                </x-date>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_anak')"
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

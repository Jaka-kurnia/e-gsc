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
                <div class="col-span-2">
                    <x-label value="Nama Orang Tua (Ibu)" />
                    <x-select-input name="ibu_id" x-model="ibu_id">
                        <option value="">-- Pilih Orang Tua --</option>
                        @foreach ($ibu as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_ibu }} ({{ $item->nik }})</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div>
                    <x-label value="NIK" />
                    <x-input name="nik" placeholder="Masukkan NIK" x-model="nik" />
                </div>

                <div>
                    <x-label value="Nama Anak" />
                    <x-input name="nama" placeholder="Masukkan Nama Anak" x-model="nama" />
                </div>

                <div>
                    <x-label value="Tanggal Lahir" />
                    <x-input type="date" name="tanggal_lahir" x-model="tanggal_lahir" />
                </div>

                <div>
                    <x-label value="Jenis Kelamin" />
                    <x-select-input name="jenis_kelamin" x-model="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Berat Badan (kg)" />
                    <x-input type="number" step="0.01" name="berat_badan" placeholder="Masukkan Berat Badan"
                        x-model="berat_badan" />
                </div>

                <div>
                    <x-label value="Tinggi Badan (cm)" />
                    <x-input type="number" step="0.01" name="tinggi_badan" placeholder="Masukkan Tinggi Badan"
                        x-model="tinggi_badan" />
                </div>
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

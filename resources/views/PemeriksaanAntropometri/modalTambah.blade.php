<x-modal name="modal_pemeriksaan_antropometri">
    <div class="p-6">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Pemeriksaan Antropometri</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="col-span-2">
                    <x-label value="Pemeriksaan" />
                    <x-select-input name="pemeriksaan_id" x-model="pemeriksaan_id">
                        <option value="">-- Pilih Pemeriksaan --</option>
                        @foreach ($pemeriksaans as $item)
                            <option value="{{ $item->id }}">{{ $item->nomor_pemeriksaan }} - {{ $item->anak->nama ?? '-' }}</option>
                        @endforeach
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

                <div>
                    <x-label value="Lingkar Kepala (cm)" />
                    <x-input type="number" step="0.01" name="lingkar_kepala" placeholder="Masukkan Lingkar Kepala"
                        x-model="lingkar_kepala" />
                </div>

                <div>
                    <x-label value="User" />
                    <x-select-input name="user_id" x-model="user_id">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Tren Pertumbuhan" />
                    <x-select-input name="tren_pertumbuhan" x-model="tren_pertumbuhan">
                        <option value="">-- Pilih Tren Pertumbuhan --</option>
                        <option value="N">N (Normal)</option>
                        <option value="T">T (Tinggi)</option>
                        <option value="BGM">BGM (Bawah Garis Merah)</option>
                        <option value="-">- (Tidak Ada)</option>
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Status Gizi" />
                    <x-select-input name="status_gizi" x-model="status_gizi">
                        <option value="">-- Pilih Status Gizi --</option>
                        <option value="normal">Normal</option>
                        <option value="gizi_kurang">Gizi Kurang</option>
                        <option value="gizi_buruk">Gizi Buruk</option>
                        <option value="gizi_lebih">Gizi Lebih</option>
                    </x-select-input>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_pemeriksaan_antropometri')"
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

<x-modal name="modal_pemeriksaan_konseling">
    <div class="p-6">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Pemeriksaan Konseling</h3>
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

                <div class="col-span-2">
                    <x-label value="User" />
                    <x-select-input name="user_id" x-model="user_id">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div class="col-span-2">
                    <x-label value="Catatan Konseling" />
                    <x-textarea name="konseling" placeholder="Masukkan Catatan Konseling" rows="4" x-model="konseling" />
                </div>

                <div class="col-span-2">
                    <input type="hidden" name="pemberian_pmt" x-bind:value="pemberian_pmt ? '1' : '0'">
                    <label class="inline-flex items-center gap-3 cursor-pointer select-none">
                        <span class="text-sm font-medium text-gray-700">Pemberian PMT</span>
                        <div class="relative w-11 h-6"
                            x-on:click="pemberian_pmt = !pemberian_pmt">
                            <div class="w-11 h-6 rounded-full transition-colors duration-200 ease-in-out"
                                x-bind:class="pemberian_pmt ? 'bg-green-500' : 'bg-gray-300'">
                            </div>
                            <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-sm transition-transform duration-200 ease-in-out"
                                x-bind:class="pemberian_pmt ? 'translate-x-5' : 'translate-x-0'">
                            </div>
                        </div>
                        <span class="text-sm font-semibold"
                            x-bind:class="pemberian_pmt ? 'text-green-600' : 'text-gray-400'"
                            x-text="pemberian_pmt ? 'Ya' : 'Tidak'">
                        </span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_pemeriksaan_konseling')"
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

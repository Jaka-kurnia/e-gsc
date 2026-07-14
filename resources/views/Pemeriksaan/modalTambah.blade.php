<x-modal name="modal_pemeriksaan">
    <div class="p-6">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900" x-text="title">Tambah Data Pemeriksaan</h3>
        </div>

        <form x-bind:action="action" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <x-label value="Nomor Pemeriksaan" />
                    <div class="w-full h-10 px-3 py-2 text-sm text-gray-900 font-semibold bg-gray-50 rounded-md border border-gray-200 select-none" x-text="nomor_pemeriksaan"></div>
                </div>

                <div>
                    <x-label value="Nomor Antrean" />
                    <div class="w-full h-10 px-3 py-2 text-sm text-gray-900 font-semibold bg-gray-50 rounded-md border border-gray-200 select-none" x-text="nomor_antri"></div>
                </div>

                <div>
                    <x-label value="Nama Anak" />
                    <x-select-input name="anak_id" x-model="anak_id">
                        <option value="">-- Pilih Anak --</option>
                        @foreach ($anak as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Nama Kegiatan (Jadwal)" />
                    <x-select-input name="jadwal_id" x-model="jadwal_id">
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach ($jadwal as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kegiatan }}</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Metode Kunjungan" />
                    <x-select-input name="metode_kunjungan" x-model="metode_kunjungan">
                        <option value="">-- Pilih Metode --</option>
                        <option value="hari_h">Hari H</option>
                        <option value="sweeping">Sweeping</option>
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Tanggal Kunjungan" />
                    <x-input type="date" name="tanggal_kunjungan" x-model="tanggal_kunjungan" />
                </div>

                <div>
                    <x-label value="Umur (Bulan)" />
                    <x-input type="number" name="umur_bulan" placeholder="Masukkan Umur (Bulan)" x-model="umur_bulan" />
                </div>

                <div>
                    <x-label value="Approval Status" />
                    <x-select-input name="approvel_status" x-model="approvel_status">
                        <option value="">-- Pilih Status --</option>
                        <option value="darft">Draft</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Penginput" />
                    <x-select-input name="user_id" x-model="user_id">
                        <option value="">-- Pilih Penginput --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div>
                    <x-label value="Verifikator" />
                    <x-select-input name="approved_by" x-model="approved_by">
                        <option value="">-- Pilih Verifikator --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-select-input>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <x-btn-danger type="button" x-on:click="$dispatch('close-modal', 'modal_pemeriksaan')"
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
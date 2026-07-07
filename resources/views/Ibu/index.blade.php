<x-app-layout>
    <x-slot name="title">Data Ibu</x-slot>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Orang Tua') }}
        </h2>
        <x-btn-primary x-data x-on:click="$dispatch('open-add-modal')" class="px-4 py-2 flex items-center gap-2">
            <i class="fi fi-rr-plus"></i>
            Tambah Data
        </x-btn-primary>
    </x-slot>

    <div x-data="ibuForm()" x-on:open-add-modal.window="openAddModal()"
        x-on:open-edit-modal.window="openEditModal($event.detail)" class="py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <!-- Form Search -->
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari  NIK atau Nama..." x-model="search" />
            </form>

            <div class="flex justify-end gap-1.5 mb-6">
                <x-btn-success>
                    <a href="#">
                        <i class="fi fi-rr-file-excel mx-2 text-xl"></i>
                        Export Excel
                    </a>
                </x-btn-success>

                <x-btn-danger>
                    <a href="#">
                        <i class="fi fi-rr-file-pdf mx-2 text-xl"></i>
                        Export PDF
                    </a>
                </x-btn-danger>
            </div>
        </div>

        <x-table>
            <thead>
                <tr>
                    <x-th class="text-center">No</x-th>
                    <x-th>NIK</x-th>
                    <x-th>Nama Ibu</x-th>
                    <x-th>Nama Ayah</x-th>
                    <x-th>No. HP</x-th>
                    <x-th>RW</x-th>
                    <x-th>RT</x-th>
                    <x-th>Alamat</x-th>
                    <x-th>Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ibu as $iterm)
                    <tr>
                        <x-td class="text-center">{{ $loop->iteration }}</x-td>
                        <x-td>{{ $iterm->nik }}</x-td>
                        <x-td>{{ $iterm->nama_ibu }}</x-td>
                        <x-td>{{ $iterm->nama_ayah }}</x-td>
                        <x-td>{{ $iterm->no_hp }}</x-td>
                        <x-td>{{ $iterm->rw }}</x-td>
                        <x-td>{{ $iterm->rt }}</x-td>
                        <x-td>
                            <div class="max-w-50 truncate" title="{{ $iterm->alamat }}">
                                {{ $iterm->alamat }}
                            </div>
                        </x-td>
                        <x-td>
                            <div class="flex gap-2">
                                <x-btn-edit type="button"
                                    x-on:click="$dispatch('open-edit-modal', {{ json_encode($iterm) }})">
                                    <i class="fi fi-rr-edit text-lg"></i>
                                </x-btn-edit>

                                <form action="{{ route('ibu.destroy', $iterm->id) }}" method="POST"
                                    id="delete-form-{{ $iterm->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-btn-delete type="button" onclick="confirmDelete('{{ $iterm->id }}')">
                                        <i class="fi fi-rr-trash text-lg"></i>
                                    </x-btn-delete>
                                </form>
                            </div>
                        </x-td>
                    </tr>
                @empty
                    <tr>
                        <x-td colspan="9" class="text-center p-0">
                            <div class="flex items-center justify-center py-10 w-full">
                                <span
                                    class="text-sm text-white bg-red-700 font-semibold px-4 py-2.5 rounded-lg flex items-center justify-center gap-2 border border-red-200 shadow-sm mx-auto">
                                    <i class="fi fi-rr-file-exclamation text-lg leading-none"></i>
                                    <span>Data Orang Tua Belum Tersedia</span>
                                </span>
                            </div>
                        </x-td>
                    </tr>
                @endforelse
            </tbody>

        </x-table>

        <x-paginate :paginator="$ibu" />

        {{-- Modal Tambah / Edit Data  --}}
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
                        <x-input label="Nama Ayah" name="nama_ayah" placeholder="Masukkan Nama Ayah"
                            x-model="nama_ayah" />
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
    </div>

    <!-- Script Alpine.js & SweetAlert2 -->
    <script>
        function ibuForm() {
            return {
                title: 'Tambah Data Orang Tua',
                action: "{{ route('ibu.store') }}",
                isEdit: false,
                nik: '',
                nama_ibu: '',
                nama_ayah: '',
                no_hp: '',
                rt: '',
                rw: '',
                alamat: '',

                openAddModal() {
                    this.title = 'Tambah Data Orang Tua';
                    this.action = "{{ route('ibu.store') }}";
                    this.isEdit = false;

                    this.nik = '';
                    this.nama_ibu = '';
                    this.nama_ayah = '';
                    this.no_hp = '';
                    this.rt = '';
                    this.rw = '';
                    this.alamat = '';

                    this.$dispatch('open-modal', 'modal_ibu');
                },

                openEditModal(data) {
                    this.title = 'Edit Data Orang Tua';
                    this.action = `/ibu/${data.id}`;
                    this.isEdit = true;

                    this.nik = data.nik;
                    this.nama_ibu = data.nama_ibu;
                    this.nama_ayah = data.nama_ayah;
                    this.no_hp = data.no_hp || '';
                    this.rt = data.rt;
                    this.rw = data.rw;
                    this.alamat = data.alamat;

                    this.$dispatch('open-modal', 'modal_ibu');
                }
            }
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>

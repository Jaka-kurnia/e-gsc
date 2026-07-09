<!-- Script SweetAlert2 untuk Konfirmasi Delete & Alpine Form/Detail -->
    <script>
        function anakForm() {
            return {
                title: 'Tambah Data Anak',
                action: "{{ route('anak.store') }}",
                isEdit: false,
                ibu_id: '',
                nik: '',
                nama: '',
                tanggal_lahir: '',
                jenis_kelamin: '',
                berat_badan: '',
                tinggi_badan: '',

                openAddModal() {
                    this.title = 'Tambah Data Anak';
                    this.action = "{{ route('anak.store') }}";
                    this.isEdit = false;
                    this.ibu_id = '';
                    this.nik = '';
                    this.nama = '';
                    this.tanggal_lahir = '';
                    this.jenis_kelamin = '';
                    this.berat_badan = '';
                    this.tinggi_badan = '';
                    this.$dispatch('open-modal', 'modal_anak');
                },

                openEditModal(data) {
                    this.title = 'Edit Data Anak';
                    this.action = `/anak/${data.id}`;
                    this.isEdit = true;
                    this.ibu_id = data.ibu_id;
                    this.nik = data.nik;
                    this.nama = data.nama;
                    this.tanggal_lahir = data.tanggal_lahir;
                    this.jenis_kelamin = data.jenis_kelamin;
                    this.berat_badan = data.berat_badan;
                    this.tinggi_badan = data.tinggi_badan;
                    this.$dispatch('open-modal', 'modal_anak');
                }
            }
        }

        function anakDetail() {
            return {
                detail: {
                    nik: '',
                    nama: '',
                    nama_orang_tua: '',
                    tanggal_lahir: '',
                    jenis_kelamin: '',
                    berat_badan: '',
                    tinggi_badan: ''
                },
                openDetail(data) {
                    this.detail = data;
                    this.$dispatch('open-modal', 'modal_detail_anak');
                }
            }
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data anak yang dihapus tidak dapat dikembalikan!",
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
<script>
    function pemeriksaanForm() {
        return {
            title: "Tambah Data Pemeriksaan",
            action: "{{ route('pemeriksaan.store') }}",
            isEdit: false,
            nomor_pemeriksaan: '',
            anak_id: '',
            jadwal_id: '',
            user_id: '',
            approved_by: '',
            nomor_antri: '',
            metode_kunjungan: '',
            tanggal_kunjungan: '',
            umur_bulan: '',
            approvel_status: '',

            openAddModal() {
                this.title = "Tambah Data Pemeriksaan";
                this.action = "{{ route('pemeriksaan.store') }}";
                this.isEdit = false;
                this.nomor_pemeriksaan = '{{ $nextNomorPemeriksaan }}';
                this.nomor_antri = '{{ $nextNomorAntri }}';
                this.anak_id = '';
                this.jadwal_id = '';
                this.user_id = '';
                this.approved_by = '';
                this.metode_kunjungan = '';
                this.tanggal_kunjungan = new Date().toISOString().split('T')[0];
                this.umur_bulan = '';
                this.approvel_status = '';
                this.$dispatch('open-modal', 'modal_pemeriksaan');
            },

            openEditModal(data) {
                this.title = "Edit Data Pemeriksaan";
                this.action = `/pemeriksaan/${data.id}`;
                this.isEdit = true;
                this.nomor_pemeriksaan = data.nomor_pemeriksaan;
                this.anak_id = data.anak_id;
                this.jadwal_id = data.jadwal_id;
                this.user_id = data.user_id;
                this.approved_by = data.approved_by;
                this.nomor_antri = data.nomor_antri;
                this.metode_kunjungan = data.metode_kunjungan;
                this.tanggal_kunjungan = data.tanggal_kunjungan;
                this.umur_bulan = data.umur_bulan;
                this.approvel_status = data.approvel_status;
                this.$dispatch('open-modal', 'modal_pemeriksaan');
            },
        }
    }

    function pemeriksaanDetail() {
        return {
            detail: {
                nomor_pemeriksaan: '',
                anak_id: '',
                jadwal_id: '',
                user_id: '',
                approved_by: '',
                nomor_antri: '',
                metode_kunjungan: '',
                tanggal_kunjungan: '',
                umur_bulan: '',
                approvel_status: '',
            },
            openDetail(data) {
                this.detail = data;
                this.$dispatch('open-modal', 'modal_detail_pemeriksaan');
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

<script>
    function pemeriksaanAntropometriForm() {
        return {
            title: 'Tambah Data Pemeriksaan Antropometri',
            action: "{{ route('pemeriksaan_antropometri.store') }}",
            isEdit: false,
            pemeriksaan_id: '',
            user_id: '',
            berat_badan: '',
            tinggi_badan: '',
            lingkar_kepala: '',
            tren_pertumbuhan: '',
            status_gizi: '',

            openAddModal() {
                this.title = 'Tambah Data Pemeriksaan Antropometri';
                this.action = "{{ route('pemeriksaan_antropometri.store') }}";
                this.isEdit = false;
                this.pemeriksaan_id = '';
                this.user_id = '';
                this.berat_badan = '';
                this.tinggi_badan = '';
                this.lingkar_kepala = '';
                this.tren_pertumbuhan = '';
                this.status_gizi = '';
                this.$dispatch('open-modal', 'modal_pemeriksaan_antropometri');
            },

            openEditModal(data) {
                this.title = 'Edit Data Pemeriksaan Antropometri';
                this.action = `/pemeriksaan_antropometri/${data.pemeriksaan_id}`;
                this.isEdit = true;
                this.pemeriksaan_id = data.pemeriksaan_id;
                this.user_id = data.user_id;
                this.berat_badan = data.berat_badan;
                this.tinggi_badan = data.tinggi_badan;
                this.lingkar_kepala = data.lingkar_kepala;
                this.tren_pertumbuhan = data.tren_pertumbuhan;
                this.status_gizi = data.status_gizi;
                this.$dispatch('open-modal', 'modal_pemeriksaan_antropometri');
            }
        }
    }

    function pemeriksaanAntropometriDetail() {
        return {
            detail: {
                nomor_pemeriksaan: '',
                nama_anak: '',
                berat_badan: '',
                tinggi_badan: '',
                lingkar_kepala: '',
                tren_pertumbuhan: '',
                status_gizi: ''
            },
            openDetail(data) {
                this.detail = data;
                this.$dispatch('open-modal', 'modal_detail_pemeriksaan_antropometri');
            }
        }
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pemeriksaan antropometri yang dihapus tidak dapat dikembalikan!",
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

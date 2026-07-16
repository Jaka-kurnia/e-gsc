<script>
    function pemeriksaanKonselingForm() {
        return {
            title: 'Tambah Data Pemeriksaan Konseling',
            action: "{{ route('pemeriksaan_konseling.store') }}",
            isEdit: false,
            pemeriksaan_id: '',
            user_id: '',
            konseling: '',
            pemberian_pmt: false,

            openAddModal() {
                this.title = 'Tambah Data Pemeriksaan Konseling';
                this.action = "{{ route('pemeriksaan_konseling.store') }}";
                this.isEdit = false;
                this.pemeriksaan_id = '';
                this.user_id = '';
                this.konseling = '';
                this.pemberian_pmt = false;
                this.$dispatch('open-modal', 'modal_pemeriksaan_konseling');
            },

            openEditModal(data) {
                this.title = 'Edit Data Pemeriksaan Konseling';
                this.action = `/pemeriksaan_konseling/${data.pemeriksaan_id}`;
                this.isEdit = true;
                this.pemeriksaan_id = data.pemeriksaan_id;
                this.user_id = data.user_id;
                this.konseling = data.konseling;
                this.pemberian_pmt = data.pemberian_pmt == 1 || data.pemberian_pmt === true;
                this.$dispatch('open-modal', 'modal_pemeriksaan_konseling');
            }
        }
    }

    function pemeriksaanKonselingDetail() {
        return {
            detail: {
                nomor_pemeriksaan: '',
                nama_anak: '',
                konseling: '',
                pemberian_pmt: ''
            },
            openDetail(data) {
                this.detail = data;
                this.$dispatch('open-modal', 'modal_detail_pemeriksaan_konseling');
            }
        }
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pemeriksaan konseling yang dihapus tidak dapat dikembalikan!",
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

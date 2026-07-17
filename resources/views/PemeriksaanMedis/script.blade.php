<script>
    function pemeriksaanMedisForm() {
        return {
            title: 'Tambah Data Pemeriksaan Medis',
            action: "{{ route('pemeriksaan_medis.store') }}",
            isEdit: false,
            pemeriksaan_id: '',
            pemberian_vitamin: 'tidak',
            pemberian_obat_cacing: false,
            status_rujukan_medis: false,
            imunisasi_id: [],
            catatan: '',

            openAddModal() {
                this.title = 'Tambah Data Pemeriksaan Medis';
                this.action = "{{ route('pemeriksaan_medis.store') }}";
                this.isEdit = false;
                this.pemeriksaan_id = '';
                this.pemberian_vitamin = 'tidak';
                this.pemberian_obat_cacing = false;
                this.status_rujukan_medis = false;
                this.imunisasi_id = [];
                this.catatan = '';
                this.$dispatch('open-modal', 'modal_pemeriksaan_medis');
            },

            openEditModal(data) {
                this.title = 'Edit Data Pemeriksaan Medis';
                this.action = `/pemeriksaan_medis/${data.pemeriksaan_id}`;
                this.isEdit = true;
                this.pemeriksaan_id = data.pemeriksaan_id;
                this.pemberian_vitamin = data.pemberian_vitamin;
                this.pemberian_obat_cacing = Boolean(data.pemberian_obat_cacing);
                this.status_rujukan_medis = Boolean(data.status_rujukan_medis);
                this.imunisasi_id = data.imunisasis ? data.imunisasis.map(i => i.id.toString()) : [];
                this.catatan = data.catatan || '';
                this.$dispatch('open-modal', 'modal_pemeriksaan_medis');
            }
        }
    }

    function pemeriksaanMedisDetail() {
        return {
            detail: {
                nomor_pemeriksaan: '',
                nama_anak: '',
                pemberian_vitamin: '',
                pemberian_obat_cacing: '',
                status_rujukan_medis: '',
                imunisasi: '',
                catatan: ''
            },
            openDetail(data) {
                this.detail = data;
                this.$dispatch('open-modal', 'modal_detail_pemeriksaan_medis');
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

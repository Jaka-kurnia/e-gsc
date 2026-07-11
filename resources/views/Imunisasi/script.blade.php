<script>
    function imunisasiForm() {
        return {
            title: "Tambah Data Imunisasi",
            action: "{{ route('imunisasi.store') }}",
            isEdit: false,
            kode_imunisasi: '',
            nama_imunisasi: '',
            deskripsi: '',

            openAddModal() {
                this.title = "Tambah Data Imunisasi";
                this.action = "{{ route('imunisasi.store') }}";
                this.isEdit = false;
                this.kode_imunisasi = '';
                this.nama_imunisasi = '';
                this.deskripsi = '';
                this.$dispatch('open-modal', 'modal_imunisasi');
            },

            openEditModal(data) {
                this.title = "Edit Data Imunisasi";
                this.action = `/imunisasi/${data.id}`;
                this.isEdit = true;
                this.kode_imunisasi = data.kode_imunisasi;
                this.nama_imunisasi = data.nama_imunisasi;
                this.deskripsi = data.deskripsi || '';
                this.$dispatch('open-modal', 'modal_imunisasi');
            },

        }
    }

   function imunisasiDetail() {
    return {
        detail: {
            kode_imunisasi: '' 
        },
        openDetail(data) { 
            this.detail = data;
            this.$dispatch('open-modal', 'modal_detail_imunisasi');
        }
    }
}
</script>

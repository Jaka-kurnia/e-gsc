  <script>
      function jadwalForm() {
          return {
              title: 'Tambah Data Jadwal',
              action: "{{ route('jadwal.store') }}",
              isEdit: false,
              nama_kegiatan: '',
              tanggal_kegiatan: '',
              status_logistik: '',
              catatan: '',

              openAddModal() {
                  this.title = 'Tambah Data Jadwal';
                  this.action = "{{ route('jadwal.store') }}";
                  this.isEdit = false;
                  this.nama_kegiatan = '';
                  this.tanggal_kegiatan = '';
                  this.status_logistik = '';
                  this.catatan = '';
                  this.$dispatch('open-modal', 'modal_jadwal');
              },

              openEditModal(data) {
                  this.title = 'Edit Data Jadwal';
                  this.action = `/jadwal/${data.id}`;
                  this.isEdit = true;
                  this.nama_kegiatan = data.nama_kegiatan;
                  this.tanggal_kegiatan = data.tanggal_kegiatan;
                  this.status_logistik = data.status_logistik;
                  this.catatan = data.catatan || '';
                  this.$dispatch('open-modal', 'modal_jadwal');
              }
          }
      }

      function jadwalDetail() {
          return {
              detail: {
                  nama_kegiatan: '',
                  tanggal_kegiatan: '',
                  status_logistik: '',
                  catatan: ''
              },
              openDetail(data) {
                  this.detail = data;
                  this.$dispatch('open-modal', 'modal_detail_jadwal');
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

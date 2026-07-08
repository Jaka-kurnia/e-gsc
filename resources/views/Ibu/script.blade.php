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

      function ibuDetail() {
          return {
              detail: {
                  nik: '',
                  nama_ibu: '',
                  nama_ayah: '',
                  no_hp: '',
                  rt: '',
                  rw: '',
                  alamat: ''
              },
              openDetail(data) {
                  this.detail = data;
                  this.$dispatch('open-modal', 'modal_detail_ibu');
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

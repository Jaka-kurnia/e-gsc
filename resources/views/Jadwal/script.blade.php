<script>
    const MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'
    ];
    const DAYS = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

    function jadwalCalendar() {
        return {
            bulan: new Date().getMonth(),
            tahun: new Date().getFullYear(),
            dragOver: false,
            draggedEvent: null,

            schedules: {!! json_encode(
                $jadwal->map(
                        fn($j) => [
                            'id' => $j->id,
                            'nama_kegiatan' => $j->nama_kegiatan,
                            'tanggal_kegiatan' => $j->tanggal_kegiatan,
                            'status_logistik' => $j->status_logistik,
                            'catatan' => $j->catatan,
                        ],
                    )->values(),
            ) !!},

            // Form state
            title: 'Tambah Data Jadwal',
            action: "{{ route('jadwal.store') }}",
            isEdit: false,
            editId: null,
            nama_kegiatan: '',
            tanggal_kegiatan: '',
            status_logistik: '',
            catatan: '',

            get hari() {
                return DAYS;
            },

            get bulanTahun() {
                return `${MONTHS[this.bulan]} ${this.tahun}`;
            },

            prevMonth() {
                this.bulan--;
                if (this.bulan < 0) {
                    this.bulan = 11;
                    this.tahun--;
                }
            },

            nextMonth() {
                this.bulan++;
                if (this.bulan > 11) {
                    this.bulan = 0;
                    this.tahun++;
                }
            },

            get minggu() {
                const firstDay = new Date(this.tahun, this.bulan, 1);
                const lastDay = new Date(this.tahun, this.bulan + 1, 0);
                const startOffset = (firstDay.getDay() + 6) % 7;
                const totalDays = lastDay.getDate();
                const totalCells = Math.ceil((startOffset + totalDays) / 7) * 7;
                const today = new Date();
                const todayStr = today.toISOString().slice(0, 10);
                const weeks = [];
                let week = [];

                for (let i = 0; i < totalCells; i++) {
                    const dayNum = i - startOffset + 1;
                    const isValid = dayNum >= 1 && dayNum <= totalDays;
                    const dateStr = isValid ?
                        `${this.tahun}-${String(this.bulan + 1).padStart(2, '0')}-${String(dayNum).padStart(2, '0')}` :
                        null;
                    const events = isValid ? this.schedules.filter(s => s.tanggal_kegiatan === dateStr) : [];

                    week.push({
                        date: isValid ? dayNum : null,
                        dateStr: dateStr,
                        isToday: dateStr === todayStr,
                        events: events
                    });

                    if (week.length === 7) {
                        weeks.push(week);
                        week = [];
                    }
                }
                return weeks;
            },

            clickDate(dateStr) {
                const events = this.schedules.filter(s => s.tanggal_kegiatan === dateStr);
                if (events.length > 0) {
                    this.openEditModal(events[0]);
                } else {
                    this.openAddModal(dateStr);
                }
            },

            editEvent(event) {
                this.openEditModal(event);
            },

            // Form methods
            openAddModal(tanggal) {
                this.title = 'Tambah Data Jadwal';
                this.action = "{{ route('jadwal.store') }}";
                this.isEdit = false;
                this.editId = null;
                this.nama_kegiatan = '';
                this.tanggal_kegiatan = tanggal || '';
                this.status_logistik = '';
                this.catatan = '';
                this.$dispatch('open-modal', 'modal_jadwal');
            },

            openEditModal(data) {
                this.title = 'Edit Data Jadwal';
                this.action = `/jadwal/${data.id}`;
                this.isEdit = true;
                this.editId = data.id;
                this.nama_kegiatan = data.nama_kegiatan;
                this.tanggal_kegiatan = data.tanggal_kegiatan;
                this.status_logistik = data.status_logistik;
                this.catatan = data.catatan || '';
                this.$dispatch('open-modal', 'modal_jadwal');
            },

            // Drag & Drop
            dragStart(event, schedule) {
                this.draggedEvent = schedule;
                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', schedule.id);
            },

            dragEnd() {
                this.draggedEvent = null;
                this.dragOver = false;
            },

            async dropOnDate(event, dateStr) {
                this.dragOver = false;
                if (!this.draggedEvent || this.draggedEvent.tanggal_kegiatan === dateStr) {
                    this.draggedEvent = null;
                    return;
                }

                const scheduleId = this.draggedEvent.id;
                const oldDate = this.draggedEvent.tanggal_kegiatan;

                // Optimistic update
                this.draggedEvent.tanggal_kegiatan = dateStr;
                this.draggedEvent = null;

                try {
                    const response = await fetch(`/jadwal/${scheduleId}/move`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            tanggal_kegiatan: dateStr
                        })
                    });

                    if (!response.ok) {
                        this.draggedEvent = this.schedules.find(s => s.id === scheduleId);
                        if (this.draggedEvent) this.draggedEvent.tanggal_kegiatan = oldDate;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal memindahkan jadwal.',
                        });
                    } else {
                        const result = await response.json();
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: result.message || 'Jadwal berhasil dipindahkan.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    }
                } catch (error) {
                    const schedule = this.schedules.find(s => s.id === scheduleId);
                    if (schedule) schedule.tanggal_kegiatan = oldDate;
                    Swal.fire({
                        icon: 'error',
                        title: 'Koneksi Error',
                        text: 'Terjadi kesalahan jaringan.',
                    });
                }
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

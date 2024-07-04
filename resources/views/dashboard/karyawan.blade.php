<style>
    .custom-tab {
        width: 50%;
    }

    .fc-button {
        background-color: #007bff !important;
        /* Warna primary */
        border: none !important;
        color: white !important;
        padding: 5px 10px !important;
        margin: 2px !important;
        border-radius: 3px !important;
    }

    .fc-button:hover {
        background-color: #0056b3 !important;
        /* Warna primary saat hover */
    }

    .fc-daygrid-day-number,
    .fc-day {
        color: black !important;
        /* Ubah warna angka tanggal menjadi hitam */
    }
</style>

<div class="row">
    <div class="col-lg-6 col-12">

        <div class="small-box bg-info">
            <div class="inner">
                @if (Auth::user()->data_pribadi->nik == null)
                    <h3>Belum Input Data</h3>
                    <h4>Silahkan Lengkapi Data Terlebih Dulu</h4>
                @else
                    <h3>{{ Auth::user()->data_pribadi->nik }}</h3>
                    <h4>{{ Auth::user()->name }} - @if (Auth::user()->data_pribadi->jabatan == null)
                            -
                        @else
                            {{ Auth::user()->data_pribadi->jabatan->nama_jabatan }}
                        @endif
                    </h4>
                @endif
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-id">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                    <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M15 8l2 0" />
                    <path d="M15 12l2 0" />
                    <path d="M7 16l10 0" />
                </svg>
            </div>
            <a href="{{ url('data_karyawan') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-6 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>Presensi</h3>
                <h4>
                    @if ($cek_presensi == 0)
                        Belum Absen
                    @else
                        Hadir
                    @endif
                </h4>
            </div>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M15 19l2 2l4 -4" />
                </svg>
            </div>
            <a href="{{ url('presensi') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        var presensis = @json($presensis);
        var pengaturan_presensi = @json($pengaturan_presensi);

        // Fungsi untuk menambahkan 10 menit ke jam_masuk
        function tambahMenit(jam, menit) {
            var parts = jam.split(':');
            var date = new Date(1970, 0, 1, parts[0], parts[1], parts[2]);
            date.setMinutes(date.getMinutes() + menit);
            return date.toTimeString().split(' ')[0];
        }

        var jam_masuk_plus_10 = tambahMenit(pengaturan_presensi.jam_masuk, 10);

        function selisih(jam_masuk, jam_keluar) {
            var jamMasukParts = jam_masuk.split(':');
            var jamKeluarParts = jam_keluar.split(':');

            var dtAwal = new Date(1970, 0, 1, jamMasukParts[0], jamMasukParts[1], jamMasukParts[2]);
            var dtAkhir = new Date(1970, 0, 1, jamKeluarParts[0], jamKeluarParts[1], jamKeluarParts[2]);

            var dtSelisih = (dtAkhir - dtAwal) / 1000; // Convert milliseconds to seconds
            var jam = Math.floor(dtSelisih / 3600); // Hitung jam
            var sisajam = dtSelisih % 3600; // Sisa detik setelah dihitung jam
            var menit = Math.floor(sisajam / 60); // Hitung menit
            var detik = Math.floor(sisajam % 60); // Hitung detik

            return {
                jam: jam,
                menit: menit,
                detik: detik
            };
        }

        var events = presensis.map(function(presensi) {
            var created_at = new Date(presensi.created_at);
            var created_at_time = created_at.toTimeString().split(' ')[0];

            // Logging untuk melihat nilai waktu
            console.log("Created At Time: " + created_at_time);
            console.log("Jam Masuk Plus 10 Time: " + jam_masuk_plus_10);

            var backgroundColor;
            var waktuTerlambat;
            var title = '<small class="badge badge-success text-center d-block">Hadir</small>';

            if (created_at_time > jam_masuk_plus_10) {
                waktuTerlambat = selisih(jam_masuk_plus_10, created_at_time);
                backgroundColor = '#dc3545'; // Warna merah untuk terlambat
                title =
                    '<small class="badge badge-danger text-center d-block">Hadir Terlambat</small><small class="badge badge-danger text-center d-block">' +
                    waktuTerlambat.jam + ' Jam ' + waktuTerlambat.menit + ' Menit ' + waktuTerlambat
                    .detik + ' Detik</small>';
                console.log("Terlambat: " + waktuTerlambat.jam + " Jam " + waktuTerlambat.menit +
                    " Menit " + waktuTerlambat.detik + " Detik");
            } else {
                backgroundColor = '#28a745'; // Warna hijau untuk hadir
            }

            return {
                title: title,
                start: presensi.created_at.split('T')[0], // Mengambil tanggal dari timestamp
                backgroundColor: backgroundColor, // Warna berdasarkan kehadiran
                borderColor: backgroundColor // Gunakan warna yang sama untuk border
            };
        });

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            buttonText: {
                today: 'Today' // Mengubah teks tombol "today" menjadi "Today"
            },
            events: events,
            eventContent: function(arg) {
                // Use innerHTML to render custom HTML
                return {
                    html: arg.event.title
                };
            }
        });

        calendar.render();
    });
</script>

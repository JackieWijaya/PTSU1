@extends('layout.master')

@section('title', 'Presensi')

@section('content')
    <style>
        .custom-tab {
            width: 50%;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Presensi</h3>
        </div>
        <div class="card-body">
            <div id="dateTimeContainer" class="d-flex flex-column align-items-center">
                <p id="fullDate" class="mb-0 fs-5"></p>
                <p id="time" class="mb-0 fs-5"></p>
            </div>
            <div class="font-size-16 font-weight-normal text-dark my-3 text-center">
                <p>Presensi dibuka pada pukul {{ $pengaturan_presensi->jam_masuk }} & {{ $pengaturan_presensi->jam_keluar }}
                    <br>
                    Presensi (Check In & Check Out) hanya bisa dilakukan 1x sehari
                    <br>
                    <small class="text-muted">(Lewat 10 menit dari jam {{ $pengaturan_presensi->jam_masuk }} dinyatakan
                        terlambat)</small>
                </p>
            </div>
            <div class="row">
                @php
                    $now = now()->setTimezone('Asia/Jakarta')->format('H:i:s'); // Ambil waktu saat ini dalam format H:i:s WIB
                @endphp
                <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                    <button id="checkIn" class="btn btn-primary w-100" data-toggle="modal" data-target="#checkModal"
                        @if ($now <= $pengaturan_presensi->jam_masuk) disabled @elseif ($cek > 0) disabled @endif>Check
                        In</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                    <button id="checkOut" class="btn btn-primary w-100" data-toggle="modal" data-target="#checkModal"
                        @if ($now <= $pengaturan_presensi->jam_keluar) disabled @elseif ($cek1 > 0) disabled @endif>Check
                        Out</button>
                </div>
            </div>
            @include('presensi.modal')
        </div>
    </div>

    <ul class="nav nav-pills ml-auto mb-3 bg-white d-flex">
        <li class="nav-item flex-fill custom-tab">
            <a class="nav-link active text-center" href="#tab_1" data-toggle="tab">Bulan Ini</a>
        </li>
        <li class="nav-item flex-fill custom-tab">
            <a class="nav-link text-center" href="#tab_2" data-toggle="tab">Riwayat Presensi</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="card tab-pane active" id="tab_1">
            <div class="card-body">
                <h3 class="card-title">Riwayat Presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h3><br>
                {{-- <h3 class="card-title">Riwayat Presensi</h3><br> --}}
                <div class="table-responsive">
                    <table id="example2" class="datatable table table-hover nowrap text-center align-middle">
                        <thead>
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Foto</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        @php
                            function selisih($jam_masuk, $jam_keluar)
                            {
                                [$h, $m, $s] = explode(':', $jam_masuk);
                                $dtAwal = mktime($h, $m, $s, '1', '1', '1');
                                [$h, $m, $s] = explode(':', $jam_keluar);
                                $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
                                $dtSelisih = $dtAkhir - $dtAwal;
                                $totalmenit = $dtSelisih / 60;
                                $jam = explode('.', $totalmenit / 60);
                                $sisamenit = $totalmenit / 60 - $jam[0];
                                $sisamenit2 = $sisamenit * 60;
                                $jml_jam = $jam[0];
                                return ['jam' => $jml_jam, 'menit' => round($sisamenit2)];
                            }
                        @endphp
                        <tbody>
                            @foreach ($presensis as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</td>
                                    <td>
                                        @if ($item->created_at == $item->updated_at)
                                            <small class="badge badge-danger">Belum Absen</small>
                                        @else
                                            {{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('storage/Presensi/' . $item->foto_masuk) }}"
                                            class="card-img-center" alt="Foto Absen" width="50px"></td>
                                    <td>
                                        @php
                                            $jam_masuk = \Carbon\Carbon::parse($item->created_at)->format('H:i:s');
                                            $jam_masuk_plus_10 = \Carbon\Carbon::parse($pengaturan_presensi->jam_masuk)
                                                ->addMinutes(10)
                                                ->format('H:i:s');
                                        @endphp
                                        {{-- @dd($jam_masuk_plus_10); --}}
                                        @if ($jam_masuk <= $jam_masuk_plus_10)
                                            <small class="badge badge-success">Hadir</small>
                                        @else
                                            @php
                                                $waktuterlambat = selisih($jam_masuk_plus_10, $jam_masuk);
                                            @endphp
                                            <small class="badge badge-danger">Terlambat {{ $waktuterlambat['jam'] }} Jam
                                                {{ $waktuterlambat['menit'] }} Menit</small>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card tab-pane" id="tab_2">
            @include('presensi.rekap')
        </div>
    </div>

    <!-- Your script -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        // Function to update date and time
        function updateDateTime() {
            var dateTimeContainer = document.getElementById('dateTimeContainer');
            var fullDateElement = document.getElementById('fullDate');
            var timeElement = document.getElementById('time');
            var daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            var now = new Date();

            // Format the date
            var dateString = daysOfWeek[now.getDay()] + ', ' +
                now.getDate() + ' ' +
                new Intl.DateTimeFormat('id-ID', {
                    month: 'long'
                }).format(now) + ' ' +
                now.getFullYear();

            // Format the time to WIB
            var options = {
                timeZone: 'Asia/Jakarta',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            };
            var timeString = now.toLocaleTimeString('id-ID', options).replace(/\./g, ':') + ' WIB';

            // Update the content
            fullDateElement.textContent = dateString;
            timeElement.textContent = timeString;

            // Update every second
            setTimeout(updateDateTime, 1000);
        }

        // Call the function to start updating date and time
        updateDateTime();
    </script>

    <script>
        // Mendengarkan klik pada tab Bulan Ini
        document.querySelector('a[href="#tab_1"]').addEventListener('click', function(event) {
            event.preventDefault(); // Menghentikan perilaku default dari link

            // Menampilkan card Riwayat Presensi dan menyembunyikan card Bulan Ini
            document.getElementById('tab_1').classList.remove('active');
            document.getElementById('tab_2').classList.add('active');
        });
    </script>
@endsection

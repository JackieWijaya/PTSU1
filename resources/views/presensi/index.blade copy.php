@extends('layout.master')

@section('title', 'Presensi')

@section('content')

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
                <p>Presensi dibuka pada pukul 08:00:00 & 17:00:00
                    <br>
                    Presensi (Check In & Check Out) hanya bisa dilakukan 1x sehari
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                    <button id="checkIn" class="btn btn-primary w-100" data-toggle="modal" data-target="#checkModal"
                        @disabled($cek > 0)>Check
                        In</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                    <button id="checkOut" class="btn btn-primary w-100" data-toggle="modal" data-target="#checkModal"
                        @disabled($cek1 > 0)>Check
                        Out</button>
                </div>
            </div>
            @include('presensi.modal')
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Riwayat Presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h3><br>
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

                <tbody>
                    {{-- @php
                        $no = 1;
                    @endphp --}}
                    @foreach ($presensis as $item)
                        <tr>
                            {{-- <td>{{ $no++ }}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}</td>
                            <td><img src="{{ asset('storage/Presensi/' . $item->foto_masuk) }}" class="card-img-center"
                                    alt="Foto Absen" width="50px"></td>
                            <td>
                                @php
                                    $jam_masuk = \Carbon\Carbon::parse($item->created_at)->format('H:i:s');
                                @endphp
                                @if ($jam_masuk <= '08:10:00')
                                    <small class="badge badge-success">Hadir</small>
                                @else
                                    <small class="badge badge-danger">Terlambat</small>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

@endsection

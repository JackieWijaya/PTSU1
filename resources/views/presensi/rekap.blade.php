@extends('layout.master')

@section('title')
    Rekap Presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="example1" class="datatable table table-hover nowrap text-center align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Hadir</th>
                        <th>Terlambat</th>
                        <th>Total Waktu Terlambat</th>
                        <th>Rekap</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($presensis as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td></td>
                            <td>{{ $item->nik }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

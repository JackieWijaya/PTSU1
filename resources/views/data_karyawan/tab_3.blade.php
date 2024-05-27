@php
    $no = 1;
@endphp

<div class="card" id="data-center">
    <div class="card-body table-responsive">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status Keluarga</th>
                    <th>Nama Anggota Keluarga</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_keluarga_kandung as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->status_keluarga }}</td>
                        <td>{{ $item->nama_anggota_keluarga }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->tempat_lahir }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</td>
                        <td>{{ $item->pendidikan }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

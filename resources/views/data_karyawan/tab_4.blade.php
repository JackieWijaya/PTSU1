@php
    $no = 1;
@endphp

<div class="card" id="data-center">
    <div class="card-body table-responsive">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenjang</th>
                    <th>Fakultas</th>
                    <th>Nama Sekolah</th>
                    <th>Jurusan</th>
                    <th>Tahun Masuk</th>
                    <th>Tahun Lulus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_pendidikan as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->jenjang }}</td>
                        <td>{{ $item->fakultas }}</td>
                        <td>{{ $item->nama_sekolah }}</td>
                        <td>{{ $item->jurusan }}</td>
                        <td>{{ $item->tahun_masuk }}</td>
                        <td>{{ $item->tahun_lulus }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

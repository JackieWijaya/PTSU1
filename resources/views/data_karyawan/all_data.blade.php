@php
    $no = 1;
@endphp

<div class="card" id="data-center">
    <div class="card-header">
        <a href="{{ url('data_karyawan/create') }}" class="btn btn-primary">Tambah Data Karyawan</a>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Jabatan</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($data_karyawan) --}}
                @foreach ($data_karyawan as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            @if ($item->nik == null)
                                -
                            @else
                                {{ $item->nik }}
                            @endif
                        </td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>
                            @if ($item->jabatans_id == null)
                                <a href="" class="btn btn-sm btn-primary">Input</a>
                            @else
                                {{ $item->jabatan->nama_jabatan }}
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-info">Detail Info</a>
                            <a href="{{ url('karyawan/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning"><span
                                    class="bi bi-pencil-square"></span></a>
                            <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama_lengkap }}" data-nik="{{ $item->nik }}"
                                data-toggle="modal" data-target="#deleteModal"><span
                                    class="bi bi-trash3"></span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

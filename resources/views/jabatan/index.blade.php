@extends('layout.master')

@section('title', 'Jabatan')

@section('content')
    <style>
        td,
        th {
            text-align: center;
        }
    </style>

    @php
        $no = 1;
    @endphp

    <div class="card">
        <div class="card-header">
            <a href="{{ url('jabatan/create') }}" class="btn btn-primary">Tambah</a>
        </div>

        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatans as $item)
                        {{-- @dd($item); --}}
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_jabatan }}</td>
                            <td>
                                <a href="{{ url('jabatan/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning"><span
                                        class="bi bi-pencil-square"></span></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_jabatan }}" data-toggle="modal"
                                    data-target="#deleteModal"><span class="bi bi-trash3"></span></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <form action="" method="POST" id="formDelete">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="mb-konfirmasi"></div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-light">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        // generate alamat URL untuk proses hapus data 
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/jabatan/' + id);

            let nama = $(this).attr('data-nama');
            $('#mb-konfirmasi').text("Apakah Anda Yakin Ingin Menghapus Data Jabatan Dengan ID " + id + " " +
                nama + " ?");
        })

        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection

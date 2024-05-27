@extends('layout.master')

@section('title', 'Jabatan')

@section('content')
    <style>
        :root {
            --errorColor: #f00e0e;
            --validColor: #0add0a;
        }

        .text-danger,
        .form-group p {
            font-size: 0.7rem;
            color: var(--errorColor);
            position: absolute;
        }
    </style>

    <a href="{{ url('jabatan') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Edit Data Jabatan</h3>
        </div>
        <div class="card-body">
            {{-- @dd($user); --}}
            <form action="{{ route('jabatan.update', ['jabatan' => $jabatan->id]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror"
                            name="nama_jabatan" id="nama_jabatan"
                            value="{{ old('nama_jabatan') ?? $jabatan->nama_jabatan }}" placeholder="Enter Nama Jabatan">

                        @error('nama_jabatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" id="btnSimpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@extends('layout.master')

@section('title', 'Data Karyawan')

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

        .bs-stepper-header {
            display: flex;
            justify-content: center;
            /* Mengatur agar konten berada di tengah */
        }

        .card hr {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
            box-sizing: border-box;
        }
    </style>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pengalaman Kerja</h3>
        </div>
        <div class="card-body p-0">
            <div class="bs-stepper linear">
                <div class="bs-stepper-header" role="tablist">

                    <div class="step" data-target="#data-pribadi">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-pribadi"
                            id="data-pribadi-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">1</span>
                        </button>
                    </div>
                    <div class="step" data-target="#data-keluarga-inti">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-keluarga-inti"
                            id="data-keluarga-inti-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">2</span>
                        </button>
                    </div>
                    <div class="step" data-target="#data-keluarga-kandung">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-keluarga-kandung"
                            id="data-keluarga-kandung-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">3</span>
                        </button>
                    </div>
                    <div class="step" data-target="#data-pendidikan">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-pendidikan"
                            id="data-pendidikan-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">4</span>
                        </button>
                    </div>
                    <div class="step" data-target="#pelatihan-sertifikat">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pelatihan-sertifikat"
                            id="pelatihan-sertifikat-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">5</span>
                        </button>
                    </div>
                    <div class="step active" data-target="#pengalaman-kerja">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pengalaman-kerja"
                            id="pengalaman-kerja-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">6</span>
                        </button>
                    </div>
                    <div class="step" data-target="#bahasa-asing">
                        <button type="button" class="step-trigger" role="tab" aria-controls="bahasa-asing"
                            id="bahasa-asing-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">7</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="pengalaman-kerja" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="pengalaman-kerja-trigger">
                        <form action="{{ route('pengalaman_kerja.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (!$pengalaman_kerja_status || $pengalaman_kerja_status->status_isi == '0')
                                    <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="nama_perusahaan">Nama Perusahaan</label>
                                        <input type="text"
                                            class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                            name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                                            placeholder="Enter Nama Perusahaan">

                                        @error('nama_perusahaan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                                            placeholder="Enter Jabatan">

                                        @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="mulai_kerja">Tanggal Mulai</label>
                                        <input type="date"
                                            class="form-control @error('mulai_kerja') is-invalid @enderror"
                                            name="mulai_kerja" id="mulai_kerja"value="{{ old('mulai_kerja') }}"
                                            placeholder="Enter Mulai">

                                        @error('mulai_kerja')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="akhir_kerja">Tanggal Akhir</label>
                                        <input type="date"
                                            class="form-control @error('akhir_kerja') is-invalid @enderror"
                                            name="akhir_kerja" id="akhir_kerja"value="{{ old('akhir_kerja') }}"
                                            placeholder="Enter Akhir">

                                        @error('akhir_kerja')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="gaji">Gaji</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i>Rp.</i></span>
                                            </div>
                                            <input type="text" class="form-control @error('gaji') is-invalid @enderror"
                                                name="gaji" id="gaji" value="{{ old('gaji') }}"
                                                pattern="[0-9]+" title="Masukkan hanya angka" placeholder="1234567890">
                                        </div>

                                        @error('gaji')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="alasan_keluar">Alasan Keluar</label>
                                        <input type="text"
                                            class="form-control @error('alasan_keluar') is-invalid @enderror"
                                            name="alasan_keluar" id="alasan_keluar" value="{{ old('alasan_keluar') }}"
                                            placeholder="Enter Alasan Keluar">

                                        @error('alasan_keluar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    @foreach ($pengalaman_kerja as $item)
                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="nama_perusahaan">Nama Perusahaan</label>
                                            <input type="text"
                                                class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                                name="nama_perusahaan" id="nama_perusahaan"
                                                value="{{ $item->nama_perusahaan }}" placeholder="Enter Nama Perusahaan"
                                                disabled>

                                            @error('nama_perusahaan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text"
                                                class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                                id="jabatan" value="{{ $item->jabatan }}" placeholder="Enter Jabatan"
                                                disabled>

                                            @error('jabatan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="mulai_kerja">Tanggal Mulai</label>
                                            <input type="date"
                                                class="form-control @error('mulai_kerja') is-invalid @enderror"
                                                name="mulai_kerja" id="mulai_kerja"value="{{ $item->mulai }}"
                                                placeholder="Enter Mulai" disabled>

                                            @error('mulai_kerja')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="akhir_kerja">Tanggal Akhir</label>
                                            <input type="date"
                                                class="form-control @error('akhir_kerja') is-invalid @enderror"
                                                name="akhir_kerja" id="akhir_kerja"value="{{ $item->akhir }}"
                                                placeholder="Enter Akhir" disabled>

                                            @error('akhir_kerja')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="gaji">Gaji</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i>Rp.</i></span>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('gaji') is-invalid @enderror"
                                                    name="gaji" id="gaji" value="{{ $item->gaji }}"
                                                    pattern="[0-9]+" title="Masukkan hanya angka"
                                                    placeholder="1234567890" disabled>
                                            </div>

                                            @error('gaji')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="alasan_keluar">Alasan Keluar</label>
                                            <input type="text"
                                                class="form-control @error('alasan_keluar') is-invalid @enderror"
                                                name="alasan_keluar" id="alasan_keluar"
                                                value="{{ $item->alasan_keluar }}" placeholder="Enter Alasan Keluar"
                                                disabled>

                                            @error('alasan_keluar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <hr class="mt-3">
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" id="checkbox"
                                    @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>
                                <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                        dengan kesadaran penuh bertanggung jawab atas keaslian data yang
                                        disimpan</small></label>
                            </div>
                            <div class="mb-4">
                                <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
                                    sudah diisi dengan benar!</p>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="status_isi" value="0"
                                    onclick="setRequired(true)" @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Tambah Data Lainnya</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#yakinModal" onclick="setRequired(false)"
                                    @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Next</button>
                            </div>
                            @include('data_karyawan.modal')

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

    <script>
        function setRequired(isRequired) {
            document.getElementById('checkbox').required = isRequired;
        }
    </script>

@endsection

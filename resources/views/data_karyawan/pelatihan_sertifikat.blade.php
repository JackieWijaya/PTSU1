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
            <h3 class="card-title">Sertifikat Pelatihan</h3>
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
                    <div class="step active" data-target="#pelatihan-sertifikat">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pelatihan-sertifikat"
                            id="pelatihan-sertifikat-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">5</span>
                        </button>
                    </div>
                    <div class="step" data-target="#pengalaman-kerja">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pengalaman-kerja"
                            id="pengalaman-kerja-trigger" aria-selected="false" disabled="disabled">
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
                    <div id="pelatihan-sertifikat" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="pelatihan-sertifikat-trigger">
                        <form action="{{ route('pelatihan_sertifikat.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (!$pelatihan_sertifikat_status || $pelatihan_sertifikat_status->status_isi == '0')
                                    <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="nama_lembaga">Nama Lembaga</label>
                                        <input type="text"
                                            class="form-control @error('nama_lembaga') is-invalid @enderror"
                                            name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga') }}"
                                            placeholder="Enter Nama Lembaga">

                                        @error('nama_lembaga')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="jenis">Jenis</label>
                                        <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                            name="jenis" id="jenis" value="{{ old('jenis') }}"
                                            placeholder="Enter Jenis">
                                        @if (!$errors->has('jenis'))
                                            <p>*Pelatihan/Lomba/Seminar/Dll</p>
                                        @endif

                                        @error('jenis')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="mulai_pelatihan">Tanggal Mulai</label>
                                        <input type="date"
                                            class="form-control @error('mulai_pelatihan') is-invalid @enderror"
                                            name="mulai_pelatihan"
                                            id="mulai_pelatihan"value="{{ old('mulai_pelatihan') }}"
                                            placeholder="Enter Mulai">

                                        @error('mulai_pelatihan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="akhir_pelatihan">Tanggal Akhir</label>
                                        <input type="date"
                                            class="form-control @error('akhir_pelatihan') is-invalid @enderror"
                                            name="akhir_pelatihan"
                                            id="akhir_pelatihan"value="{{ old('akhir_pelatihan') }}"
                                            placeholder="Enter Akhir">

                                        @error('akhir_pelatihan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    @foreach ($pelatihan_sertifikat as $item)
                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="nama_lembaga">Nama Lembaga</label>
                                            <input type="text"
                                                class="form-control @error('nama_lembaga') is-invalid @enderror"
                                                name="nama_lembaga" id="nama_lembaga" value="{{ $item->nama_lembaga }}"
                                                placeholder="Enter Nama Lembaga" disabled>

                                            @error('nama_lembaga')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="jenis">Jenis</label>
                                            <input type="text"
                                                class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                                                id="jenis" value="{{ $item->jenis }}" placeholder="Enter Jenis"
                                                disabled>
                                            @if (!$errors->has('jenis'))
                                                <p>*Pelatihan/Lomba/Seminar/Dll</p>
                                            @endif

                                            @error('jenis')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="mulai_pelatihan">Tanggal Mulai</label>
                                            <input type="date"
                                                class="form-control @error('mulai_pelatihan') is-invalid @enderror"
                                                name="mulai_pelatihan" id="mulai_pelatihan"value="{{ $item->mulai }}"
                                                placeholder="Enter Mulai" disabled>

                                            @error('mulai_pelatihan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="akhir_pelatihan">Tanggal Akhir</label>
                                            <input type="date"
                                                class="form-control @error('akhir_pelatihan') is-invalid @enderror"
                                                name="akhir_pelatihan" id="akhir_pelatihan"value="{{ $item->akhir }}"
                                                placeholder="Enter Akhir" disabled>

                                            @error('akhir_pelatihan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <hr class="mt-3">
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" id="checkbox"
                                    @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>
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
                                    onclick="setRequired(true)" @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Tambah Data Lainnya</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#yakinModal" onclick="setRequired(false)"
                                    @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Next</button>
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

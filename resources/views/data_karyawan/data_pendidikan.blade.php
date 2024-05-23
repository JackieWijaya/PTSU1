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
            <h3 class="card-title">Data Pendidikan</h3>
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
                    <div class="step active" data-target="#data-pendidikan">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-pendidikan"
                            id="data-pendidikan-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">4</span>
                        </button>
                    </div>
                    <div class="step" data-target="#pelatihan-sertifikat">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pelatihan-sertifikat"
                            id="pelatihan-sertifikat-trigger" aria-selected="false" disabled="disabled">
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
                    <div id="data-pendidikan" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="data-pendidikan-trigger">
                        <form action="{{ route('data_pendidikan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (!$data_pendidikan_status || $data_pendidikan_status->status_isi == '0')
                                    <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="jenjang">Jenjang</label>
                                        <select name="jenjang" id="jenjang"
                                            class="form-control @error('jenjang') is-invalid @enderror">
                                            <option value="">-- Pilih Jenjang --</option>
                                            <option value="SD"{{ old('jenjang') == 'SD' ? 'selected' : '' }}>
                                                SD
                                            </option>
                                            <option value="SMP"{{ old('jenjang') == 'SMP' ? 'selected' : '' }}>
                                                SMP
                                            </option>
                                            <option value="SMA"{{ old('jenjang') == 'SMA' ? 'selected' : '' }}>
                                                SMA
                                            </option>
                                            <option value="D3"{{ old('jenjang') == 'D3' ? 'selected' : '' }}>
                                                D3
                                            </option>
                                            <option value="S1"{{ old('jenjang') == 'S1' ? 'selected' : '' }}>
                                                S1
                                            </option>
                                            <option value="S2"{{ old('jenjang') == 'S2' ? 'selected' : '' }}>
                                                S2
                                            </option>
                                        </select>

                                        @error('jenjang')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="fakultas">Fakultas</label>
                                        {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP/SMA)</small> --}}
                                        <input type="text" class="form-control @error('fakultas') is-invalid @enderror"
                                            name="fakultas" id="fakultas" value="{{ old('fakultas') }}"
                                            placeholder="Enter Fakultas">
                                        {{-- @if (!$errors->has('fakultas'))
                                            <p>*Input "-" Jika Jenjang SD/SMP/SMA</p>
                                        @endif --}}

                                        @error('fakultas')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="nama_sekolah">Nama Sekolah</label>
                                        <input type="text"
                                            class="form-control @error('nama_sekolah') is-invalid @enderror"
                                            name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah') }}"
                                            placeholder="Enter Nama Sekolah">

                                        @error('nama_sekolah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="jurusan">Jurusan</label>
                                        {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP)</small> --}}
                                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                            name="jurusan" id="jurusan" value="{{ old('jurusan') }}"
                                            placeholder="Enter Jurusan">
                                        {{-- @if (!$errors->has('jurusan'))
                                            <p>*Input "-" Jika Jenjang SD/SMP</p>
                                        @endif --}}

                                        @error('jurusan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="tahun_masuk">Tahun Masuk</label>
                                        <input type="text"
                                            class="form-control @error('tahun_masuk') is-invalid @enderror"
                                            name="tahun_masuk" id="tahun_masuk" value="{{ old('tahun_masuk') }}"
                                            placeholder="Enter Tahun Masuk">

                                        @error('tahun_masuk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                        <label for="tahun_lulus">Tahun Lulus</label>
                                        <input type="text"
                                            class="form-control @error('tahun_lulus') is-invalid @enderror"
                                            name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus') }}"
                                            placeholder="Enter Tahun Lulus">

                                        @error('tahun_lulus')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    @foreach ($data_pendidikan as $item)
                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="jenjang">Jenjang</label>
                                            <select name="jenjang" id="jenjang"
                                                class="form-control @error('jenjang') is-invalid @enderror" disabled>
                                                <option value="">-- Pilih Jenjang --</option>
                                                <option value="SD"{{ $item->jenjang == 'SD' ? 'selected' : '' }}>
                                                    SD
                                                </option>
                                                <option value="SMP"{{ $item->jenjang == 'SMP' ? 'selected' : '' }}>
                                                    SMP
                                                </option>
                                                <option value="SMA"{{ $item->jenjang == 'SMA' ? 'selected' : '' }}>
                                                    SMA
                                                </option>
                                                <option value="D3"{{ $item->jenjang == 'D3' ? 'selected' : '' }}>
                                                    D3
                                                </option>
                                                <option value="S1"{{ $item->jenjang == 'S1' ? 'selected' : '' }}>
                                                    S1
                                                </option>
                                                <option value="S2"{{ $item->jenjang == 'S2' ? 'selected' : '' }}>
                                                    S2
                                                </option>
                                            </select>

                                            @error('jenjang')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="fakultas">Fakultas</label>
                                            {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP/SMA)</small> --}}
                                            <input type="text"
                                                class="form-control @error('fakultas') is-invalid @enderror"
                                                name="fakultas" id="fakultas" value="{{ $item->fakultas }}"
                                                placeholder="Enter Fakultas" disabled>
                                            {{-- @if (!$errors->has('fakultas'))
                                            <p>*Input "-" Jika Jenjang SD/SMP/SMA</p>
                                        @endif --}}

                                            @error('fakultas')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="nama_sekolah">Nama Sekolah</label>
                                            <input type="text"
                                                class="form-control @error('nama_sekolah') is-invalid @enderror"
                                                name="nama_sekolah" id="nama_sekolah" value="{{ $item->nama_sekolah }}"
                                                placeholder="Enter Nama Sekolah" disabled>

                                            @error('nama_sekolah')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="jurusan">Jurusan</label>
                                            {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP)</small> --}}
                                            <input type="text"
                                                class="form-control @error('jurusan') is-invalid @enderror" name="jurusan"
                                                id="jurusan" value="{{ $item->jurusan }}" placeholder="Enter Jurusan"
                                                disabled>
                                            {{-- @if (!$errors->has('jurusan'))
                                            <p>*Input "-" Jika Jenjang SD/SMP</p>
                                        @endif --}}

                                            @error('jurusan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="tahun_masuk">Tahun Masuk</label>
                                            <input type="text"
                                                class="form-control @error('tahun_masuk') is-invalid @enderror"
                                                name="tahun_masuk" id="tahun_masuk" value="{{ $item->tahun_masuk }}"
                                                placeholder="Enter Tahun Masuk" disabled>

                                            @error('tahun_masuk')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                            <label for="tahun_lulus">Tahun Lulus</label>
                                            <input type="text"
                                                class="form-control @error('tahun_lulus') is-invalid @enderror"
                                                name="tahun_lulus" id="tahun_lulus" value="{{ $item->tahun_lulus }}"
                                                placeholder="Enter Tahun Lulus" disabled>

                                            @error('tahun_lulus')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <hr class="mt-3">
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" id="checkbox"
                                    @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>
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
                                    onclick="setRequired(true)" @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Tambah Data Lainnya</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#yakinModal" onclick="setRequired(false)"
                                    @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Next</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var jenjangSelect = document.getElementById('jenjang');
            var fakultasInput = document.getElementById('fakultas');
            var jurusanInput = document.getElementById('jurusan');
            var form = jenjangSelect.closest('form');

            jenjangSelect.addEventListener('change', function() {
                var jenjang = this.value;

                if (jenjang === 'SD' || jenjang === 'SMP' || jenjang === 'SMA') {
                    fakultasInput.value = '-';
                    fakultasInput.disabled = true;
                } else {
                    fakultasInput.value = '';
                    fakultasInput.disabled = false;
                }

                if (jenjang === 'SD' || jenjang === 'SMP') {
                    jurusanInput.value = '-';
                    jurusanInput.disabled = true;
                } else {
                    jurusanInput.value = '';
                    jurusanInput.disabled = false;
                }
            });

            form.addEventListener('submit', function() {
                // Enable inputs before submitting the form
                fakultasInput.disabled = false;
                jurusanInput.disabled = false;
            });
        });
    </script>


@endsection

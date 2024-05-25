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
            <h3 class="card-title">Data Keluarga Inti</h3>
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
                    <div class="step active" data-target="#data-keluarga-inti">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-keluarga-inti"
                            id="data-keluarga-inti-trigger" aria-selected="true">
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
                    <div id="data-keluarga-inti" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="data-keluarga-inti-trigger">
                        <form action="{{ route('data_keluarga_inti.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (!$data_keluarga_inti_status || $data_keluarga_inti_status->status_isi == '0')
                                    <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="nik_inti">NIK</label>
                                        <small class="text-muted">(Isi 0 Jika Belum Ada)</small>
                                        <input type="text" class="form-control @error('nik_inti') is-invalid @enderror"
                                            name="nik_inti" id="nik_inti" value="{{ old('nik_inti') }}"
                                            placeholder="Enter NIK" @disabled($data_pribadi->status_kawin == 'TK')>

                                        @error('nik_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="status_keluarga_inti">Status Keluarga</label>
                                        <select name="status_keluarga_inti" id="status_keluarga_inti"
                                            class="form-control @error('status_keluarga_inti') is-invalid @enderror"
                                            @disabled($data_pribadi->status_kawin == 'TK')>
                                            <option value="">-- Pilih Status Keluarga --</option>
                                            <option
                                                value="Istri"{{ old('status_keluarga_inti') == 'Istri' ? 'selected' : '' }}>
                                                Istri</option>
                                            <option
                                                value="Suami"{{ old('status_keluarga_inti') == 'Suami' ? 'selected' : '' }}>
                                                Suami</option>
                                            @foreach (range(1, 10) as $i)
                                                <option
                                                    value="Anak {{ $i }}"{{ old('status_keluarga_inti') == "Anak $i" ? 'selected' : '' }}>
                                                    Anak {{ $i }}</option>
                                            @endforeach
                                        </select>

                                        @error('status_keluarga_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="nama_anggota_keluarga_inti">Nama Anggota Keluarga</label>
                                        <input type="text"
                                            class="form-control @error('nama_anggota_keluarga_inti') is-invalid @enderror"
                                            name="nama_anggota_keluarga_inti" id="nama_anggota_keluarga_inti"
                                            value="{{ old('nama_anggota_keluarga_inti') }}"
                                            placeholder="Enter Nama Anggota Keluarga" @disabled($data_pribadi->status_kawin == 'TK')>

                                        @error('nama_anggota_keluarga_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="tempat_lahir_inti">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir_inti') is-invalid @enderror"
                                            name="tempat_lahir_inti" id="tempat_lahir_inti"
                                            value="{{ old('tempat_lahir_inti') }}" placeholder="Enter Tempat Lahir"
                                            @disabled($data_pribadi->status_kawin == 'TK')>

                                        @error('tempat_lahir_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label for="tanggal_lahir_inti">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir_inti') is-invalid @enderror"
                                            name="tanggal_lahir_inti"
                                            id="tanggal_lahir_inti"value="{{ old('tanggal_lahir_inti') }}"
                                            placeholder="Enter Tanggal Lahir" @disabled($data_pribadi->status_kawin == 'TK')>

                                        @error('tanggal_lahir_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label for="pendidikan_inti">Pendidikan</label>
                                        <select name="pendidikan_inti" id="pendidikan_inti"
                                            class="form-control @error('pendidikan_inti') is-invalid @enderror"
                                            @disabled($data_pribadi->status_kawin == 'TK')>
                                            <option value="">-- Pilih Pendidikan --</option>
                                            <option
                                                value="Belum Sekolah"{{ old('pendidikan_inti') == 'Belum Sekolah' ? 'selected' : '' }}>
                                                Belum Sekolah
                                            </option>
                                            <option value="SD"{{ old('pendidikan_inti') == 'SD' ? 'selected' : '' }}>
                                                SD
                                            </option>
                                            <option value="SMP"{{ old('pendidikan_inti') == 'SMP' ? 'selected' : '' }}>
                                                SMP
                                            </option>
                                            <option value="SMA"{{ old('pendidikan_inti') == 'SMA' ? 'selected' : '' }}>
                                                SMA
                                            </option>
                                            <option value="D3"{{ old('pendidikan_inti') == 'D3' ? 'selected' : '' }}>
                                                D3
                                            </option>
                                            <option value="S1"{{ old('pendidikan_inti') == 'S1' ? 'selected' : '' }}>
                                                S1
                                            </option>
                                            <option value="S2"{{ old('pendidikan_inti') == 'S2' ? 'selected' : '' }}>
                                                S2
                                            </option>
                                        </select>

                                        @error('pendidikan_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                        <label for="pekerjaan_inti">Pekerjaan</label>
                                        <small class="text-muted">(Isi - Jika Pendidikan Belum Sekolah)</small>
                                        <input type="text"
                                            class="form-control @error('pekerjaan_inti') is-invalid @enderror"
                                            name="pekerjaan_inti" id="pekerjaan_inti"
                                            value="{{ old('pekerjaan_inti') }}" placeholder="Enter Pekerjaan"
                                            @disabled($data_pribadi->status_kawin == 'TK')>
                                        @if (!$errors->has('pekerjaan_inti'))
                                            <p>*Jika Tidak Berkerja Isi Siswa Untuk SD - SMA | Isi Mahasiswa Untuk D3 - S2
                                            </p>
                                        @endif

                                        @error('pekerjaan_inti')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="ktp_pasangan">KTP Pasangan</label>
                                        <input type="file"
                                            class="form-control @error('ktp_pasangan') is-invalid @enderror"
                                            id="ktp_pasangan" name="ktp_pasangan" value="{{ old('ktp_pasangan') }}"
                                            placeholder="Enter KTP Pasangan" @disabled($data_pribadi->status_kawin == 'TK')>
                                        @if (!$errors->has('ktp_pasangan'))
                                            <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                        @endif

                                        @error('ktp_pasangan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    @foreach ($data_keluarga_inti as $item)
                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="nik_inti">NIK</label>
                                            <small class="text-muted">(Isi 0 Jika Belum Ada)</small>
                                            <input type="text"
                                                class="form-control @error('nik_inti') is-invalid @enderror"
                                                name="nik_inti" id="nik_inti" value="{{ $item->nik }}"
                                                placeholder="Enter NIK" disabled>

                                            @error('nik_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="status_keluarga_inti">Status Keluarga</label>
                                            <select name="status_keluarga_inti" id="status_keluarga_inti"
                                                class="form-control @error('status_keluarga_inti') is-invalid @enderror"
                                                disabled>
                                                <option value="">-- Pilih Status Keluarga --</option>
                                                <option
                                                    value="Istri"{{ $item->status_keluarga == 'Istri' ? 'selected' : '' }}>
                                                    Istri</option>
                                                <option
                                                    value="Suami"{{ $item->status_keluarga == 'Suami' ? 'selected' : '' }}>
                                                    Suami</option>
                                                @foreach (range(1, 10) as $i)
                                                    <option
                                                        value="Anak {{ $i }}"{{ $item->status_keluarga == "Anak $i" ? 'selected' : '' }}>
                                                        Anak {{ $i }}</option>
                                                @endforeach
                                            </select>

                                            @error('status_keluarga_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="nama_anggota_keluarga_inti">Nama Anggota Keluarga</label>
                                            <input type="text"
                                                class="form-control @error('nama_anggota_keluarga_inti') is-invalid @enderror"
                                                name="nama_anggota_keluarga_inti" id="nama_anggota_keluarga_inti"
                                                value="{{ $item->nama_anggota_keluarga }}"
                                                placeholder="Enter Nama Anggota Keluarga" disabled>

                                            @error('nama_anggota_keluarga_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="tempat_lahir_inti">Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir_inti') is-invalid @enderror"
                                                name="tempat_lahir_inti" id="tempat_lahir_inti"
                                                value="{{ $item->tempat_lahir }}" placeholder="Enter Tempat Lahir"
                                                disabled>

                                            @error('tempat_lahir_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <label for="tanggal_lahir_inti">Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir_inti') is-invalid @enderror"
                                                name="tanggal_lahir_inti"
                                                id="tanggal_lahir_inti"value="{{ $item->tanggal_lahir }}"
                                                placeholder="Enter Tanggal Lahir" disabled>

                                            @error('tanggal_lahir_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <label for="pendidikan_inti">Pendidikan</label>
                                            <select name="pendidikan_inti" id="pendidikan_inti"
                                                class="form-control @error('pendidikan_inti') is-invalid @enderror"
                                                disabled>
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option
                                                    value="Belum Sekolah"{{ $item->pendidikan == 'Belum Sekolah' ? 'selected' : '' }}>
                                                    Belum Sekolah
                                                </option>
                                                <option value="SD"{{ $item->pendidikan == 'SD' ? 'selected' : '' }}>
                                                    SD
                                                </option>
                                                <option value="SMP"{{ $item->pendidikan == 'SMP' ? 'selected' : '' }}>
                                                    SMP
                                                </option>
                                                <option value="SMA"{{ $item->pendidikan == 'SMA' ? 'selected' : '' }}>
                                                    SMA
                                                </option>
                                                <option value="D3"{{ $item->pendidikan == 'D3' ? 'selected' : '' }}>
                                                    D3
                                                </option>
                                                <option value="S1"{{ $item->pendidikan == 'S1' ? 'selected' : '' }}>
                                                    S1
                                                </option>
                                                <option value="S2"{{ $item->pendidikan == 'S2' ? 'selected' : '' }}>
                                                    S2
                                                </option>
                                            </select>

                                            @error('pendidikan_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label for="pekerjaan_inti">Pekerjaan</label>
                                            <small class="text-muted">(Isi - Jika Pendidikan Belum Sekolah)</small>
                                            <input type="text"
                                                class="form-control @error('pekerjaan_inti') is-invalid @enderror"
                                                name="pekerjaan_inti" id="pekerjaan_inti" value="{{ $item->pekerjaan }}"
                                                placeholder="Enter Pekerjaan" disabled>
                                            @if (!$errors->has('pekerjaan_inti'))
                                                <p>*Jika Tidak Berkerja Isi Siswa Untuk SD - SMA | Isi Mahasiswa Untuk D3 -
                                                    S2
                                                </p>
                                            @endif

                                            @error('pekerjaan_inti')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="ktp_pasangan">KTP Pasangan</label>
                                            <input type="file"
                                                class="form-control @error('ktp_pasangan') is-invalid @enderror"
                                                id="ktp_pasangan" name="ktp_pasangan" value="{{ $item->ktp_pasangan }}"
                                                placeholder="Enter KTP Pasangan" disabled>
                                            @if (!$errors->has('ktp_pasangan'))
                                                <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                            @endif

                                            @error('ktp_pasangan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <hr class="mt-3">
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" id="checkbox"
                                    @disabled(
                                        ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                            $data_pribadi->status_kawin == 'TK')>
                                <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                        dengan
                                        kesadaran penuh bertanggung jawab atas keaslian data yang disimpan</small></label>
                            </div>
                            <div class="mb-4">
                                <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
                                    sudah diisi dengan benar!</p>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="status_isi" value="0"
                                    onclick="setRequired(true)" @disabled(
                                        ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                            $data_pribadi->status_kawin == 'TK')>Tambah
                                    Data Lainnya</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#yakinModal" onclick="setRequired(false)"
                                    @disabled(
                                        ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                            $data_pribadi->status_kawin == 'TK')>Next</button>
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

        // Function to toggle visibility of fields based on marital status
        function toggleMaritalFields() {
            var statusKeluargaInti = document.getElementById('status_keluarga_inti').value;
            var ktpPasanganField = document.getElementById('ktp_pasangan').closest('.form-group');

            // Check if marital status is selected and not "Tidak Kawin"
            if (statusKeluargaInti === 'Istri' || statusKeluargaInti === 'Suami') {
                ktpPasanganField.style.display = 'block';
                document.getElementById('ktp_pasangan').setAttribute('required', 'required');
            } else {
                ktpPasanganField.style.display = 'none';
                document.getElementById('ktp_pasangan').removeAttribute('required');
            }
        }

        // Call the function initially to set the fields based on the current value of status_kawin
        toggleMaritalFields();

        // Add event listener to status_kawin field to toggle visibility of other fields
        document.getElementById('status_keluarga_inti').addEventListener('change', function() {
            toggleMaritalFields();
        });

        // Hide fields if marital status is not selected initially
        document.addEventListener('DOMContentLoaded', function() {
            toggleMaritalFields();
        });
    </script>

@endsection

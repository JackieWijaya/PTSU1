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
            <h3 class="card-title">Data Keluarga Kandung</h3>
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
                    <div class="step active" data-target="#data-keluarga-kandung">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-keluarga-kandung"
                            id="data-keluarga-kandung-trigger" aria-selected="true">
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
                    <div id="data-keluarga-kandung" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="data-keluarga-kandung-trigger">
                        <form action="{{ route('data_keluarga_kandung.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (!$data_keluarga_kandung_status || $data_keluarga_kandung_status->status_isi == '0')
                                    <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label for="status_keluarga_kandung">Status Keluarga</label>
                                        <select name="status_keluarga_kandung" id="status_keluarga_kandung"
                                            class="form-control @error('status_keluarga_kandung') is-invalid @enderror">
                                            <option value="">-- Pilih Status Keluarga --</option>
                                            <option
                                                value="Ayah Kandung"{{ old('status_keluarga_kandung') == 'Ayah Kandung' ? 'selected' : '' }}>
                                                Ayah Kandung</option>
                                            <option
                                                value="Ibu Kandung"{{ old('status_keluarga_kandung') == 'Ibu Kandung' ? 'selected' : '' }}>
                                                Ibu Kandung</option>
                                            <option
                                                value="Ayah Mertua"{{ old('status_keluarga_kandung') == 'Ayah Mertua' ? 'selected' : '' }}>
                                                Ayah Mertua</option>
                                            <option
                                                value="Ibu Mertua"{{ old('status_keluarga_kandung') == 'Ibu Mertua' ? 'selected' : '' }}>
                                                Ibu Mertua</option>
                                            @foreach (range(1, 10) as $i)
                                                <option
                                                    value="Saudara {{ $i }}"{{ old('status_keluarga_kandung') == "Saudara $i" ? 'selected' : '' }}>
                                                    Saudara {{ $i }}</option>
                                            @endforeach
                                        </select>

                                        @error('status_keluarga_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label for="nama_anggota_keluarga_kandung">Nama Anggota Keluarga</label>
                                        <input type="text"
                                            class="form-control @error('nama_anggota_keluarga_kandung') is-invalid @enderror"
                                            name="nama_anggota_keluarga_kandung" id="nama_anggota_keluarga_kandung"
                                            value="{{ old('nama_anggota_keluarga_kandung') }}"
                                            placeholder="Enter Nama Anggota Keluarga">

                                        @error('nama_anggota_keluarga_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label for="jenis_kelamin_kandung">Jenis Kelamin</label>
                                        <select name="jenis_kelamin_kandung" id="jenis_kelamin_kandung"
                                            class="form-control @error('jenis_kelamin_kandung') is-invalid @enderror">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option
                                                value="Laki-Laki"{{ old('jenis_kelamin_kandung') == 'Laki-Laki' ? 'selected' : '' }}>
                                                Laki-Laki
                                            </option>
                                            <option
                                                value="Perempuan"{{ old('jenis_kelamin_kandung') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>

                                        @error('jenis_kelamin_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label for="tempat_lahir_kandung">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir_kandung') is-invalid @enderror"
                                            name="tempat_lahir_kandung" id="tempat_lahir_kandung"
                                            value="{{ old('tempat_lahir_kandung') }}" placeholder="Enter Tempat Lahir">

                                        @error('tempat_lahir_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                                        <label for="tanggal_lahir_kandung">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir_kandung') is-invalid @enderror"
                                            name="tanggal_lahir_kandung"
                                            id="tanggal_lahir_kandung"value="{{ old('tanggal_lahir_kandung') }}"
                                            placeholder="Enter Tanggal Lahir">

                                        @error('tanggal_lahir_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                                        <label for="pendidikan_kandung">Pendidikan</label>
                                        <select name="pendidikan_kandung" id="pendidikan_kandung"
                                            class="form-control @error('pendidikan_kandung') is-invalid @enderror">
                                            <option value="">-- Pilih Pendidikan --</option>
                                            <option
                                                value="Belum Sekolah"{{ old('pendidikan_kandung') == 'Belum Sekolah' ? 'selected' : '' }}>
                                                Belum Sekolah
                                            </option>
                                            <option
                                                value="SD"{{ old('pendidikan_kandung') == 'SD' ? 'selected' : '' }}>
                                                SD
                                            </option>
                                            <option
                                                value="SMP"{{ old('pendidikan_kandung') == 'SMP' ? 'selected' : '' }}>
                                                SMP
                                            </option>
                                            <option
                                                value="SMA"{{ old('pendidikan_kandung') == 'SMA' ? 'selected' : '' }}>
                                                SMA
                                            </option>
                                            <option
                                                value="D3"{{ old('pendidikan_kandung') == 'D3' ? 'selected' : '' }}>
                                                D3
                                            </option>
                                            <option
                                                value="S1"{{ old('pendidikan_kandung') == 'S1' ? 'selected' : '' }}>
                                                S1
                                            </option>
                                            <option
                                                value="S2"{{ old('pendidikan_kandung') == 'S2' ? 'selected' : '' }}>
                                                S2
                                            </option>
                                        </select>

                                        @error('pendidikan_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-3 col-md-4 col-sm-12">
                                        <label for="pekerjaan_kandung">Pekerjaan</label>
                                        <input type="text"
                                            class="form-control @error('pekerjaan_kandung') is-invalid @enderror"
                                            name="pekerjaan_kandung" id="pekerjaan_kandung"
                                            value="{{ old('pekerjaan_kandung') }}" placeholder="Enter Pekerjaan">

                                        @error('pekerjaan_kandung')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    @foreach ($data_keluarga_kandung as $item)
                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <label for="status_keluarga_kandung">Status Keluarga</label>
                                            <select name="status_keluarga_kandung" id="status_keluarga_kandung"
                                                class="form-control @error('status_keluarga_kandung') is-invalid @enderror"
                                                disabled>
                                                <option value="">-- Pilih Status Keluarga --</option>
                                                <option
                                                    value="Ayah Kandung"{{ $item->status_keluarga == 'Ayah Kandung' ? 'selected' : '' }}>
                                                    Ayah Kandung</option>
                                                <option
                                                    value="Ibu Kandung"{{ $item->status_keluarga == 'Ibu Kandung' ? 'selected' : '' }}>
                                                    Ibu Kandung</option>
                                                <option
                                                    value="Ayah Mertua"{{ $item->status_keluarga == 'Ayah Mertua' ? 'selected' : '' }}>
                                                    Ayah Mertua</option>
                                                <option
                                                    value="Ibu Mertua"{{ $item->status_keluarga == 'Ibu Mertua' ? 'selected' : '' }}>
                                                    Ibu Mertua</option>
                                                @foreach (range(1, 10) as $i)
                                                    <option
                                                        value="Saudara {{ $i }}"{{ $item->status_keluarga == "Saudara $i" ? 'selected' : '' }}>
                                                        Saudara {{ $i }}</option>
                                                @endforeach
                                            </select>

                                            @error('status_keluarga_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <label for="nama_anggota_keluarga_kandung">Nama Anggota Keluarga</label>
                                            <input type="text"
                                                class="form-control @error('nama_anggota_keluarga_kandung') is-invalid @enderror"
                                                name="nama_anggota_keluarga_kandung" id="nama_anggota_keluarga_kandung"
                                                value="{{ $item->nama_anggota_keluarga }}"
                                                placeholder="Enter Nama Anggota Keluarga" disabled>

                                            @error('nama_anggota_keluarga_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <label for="jenis_kelamin_kandung">Jenis Kelamin</label>
                                            <select name="jenis_kelamin_kandung" id="jenis_kelamin_kandung"
                                                class="form-control @error('jenis_kelamin_kandung') is-invalid @enderror"
                                                disabled>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option
                                                    value="Laki-Laki"{{ $item->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                    Laki-Laki
                                                </option>
                                                <option
                                                    value="Perempuan"{{ $item->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>

                                            @error('jenis_kelamin_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="tempat_lahir_kandung">Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir_kandung') is-invalid @enderror"
                                                name="tempat_lahir_kandung" id="tempat_lahir_kandung"
                                                value="{{ $item->tempat_lahir }}" placeholder="Enter Tempat Lahir"
                                                disabled>

                                            @error('tempat_lahir_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-4 col-sm-12">
                                            <label for="tanggal_lahir_kandung">Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir_kandung') is-invalid @enderror"
                                                name="tanggal_lahir_kandung"
                                                id="tanggal_lahir_kandung"value="{{ $item->tanggal_lahir }}"
                                                placeholder="Enter Tanggal Lahir" disabled>

                                            @error('tanggal_lahir_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-4 col-sm-12">
                                            <label for="pendidikan_kandung">Pendidikan</label>
                                            <select name="pendidikan_kandung" id="pendidikan_kandung"
                                                class="form-control @error('pendidikan_kandung') is-invalid @enderror"
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

                                            @error('pendidikan_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-4 col-sm-12">
                                            <label for="pekerjaan_kandung">Pekerjaan</label>
                                            <input type="text"
                                                class="form-control @error('pekerjaan_kandung') is-invalid @enderror"
                                                name="pekerjaan_kandung" id="pekerjaan_kandung"
                                                value="{{ $item->pekerjaan }}" placeholder="Enter Pekerjaan" disabled>

                                            @error('pekerjaan_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <hr class="mt-3">
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" id="checkbox"
                                    @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>
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
                                    onclick="setRequired(true)" @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Tambah Data Lainnya</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#yakinModal" onclick="setRequired(false)"
                                    @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Next</button>
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
            var statusKeluargaKandung = document.getElementById('status_keluarga_kandung');
            var jenisKelaminKandung = document.getElementById('jenis_kelamin_kandung');

            statusKeluargaKandung.addEventListener('change', function() {
                var statusKeluarga = this.value;

                if (statusKeluarga === 'Ayah Kandung' || statusKeluarga === 'Ayah Mertua') {
                    jenisKelaminKandung.value = 'Laki-Laki';
                } else if (statusKeluarga === 'Ibu Kandung' || statusKeluarga === 'Ibu Mertua') {
                    jenisKelaminKandung.value = 'Perempuan';
                } else {
                    jenisKelaminKandung.value = ''; // Kosongkan jika status keluarga tidak sesuai
                }
            });
        });
    </script>


@endsection

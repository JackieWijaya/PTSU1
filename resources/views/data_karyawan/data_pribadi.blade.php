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
    </style>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Pribadi</h3>
        </div>
        <div class="card-body p-0">
            <div class="bs-stepper linear">
                <div class="bs-stepper-header" role="tablist">

                    <div class="step active" data-target="#data-pribadi">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-pribadi"
                            id="data-pribadi-trigger" aria-selected="true">
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
                    <div id="data-pribadi" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="data-pribadi-trigger">
                        <form action="{{ route('data_pribadi.update', ['data_pribadi' => $data_pribadi->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="row">
                                <div class="col-lg-9 col-md-6 col-sm-6">

                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                name="nama_lengkap" id="nama_lengkap"
                                                value="{{ $data_pribadi->nama_lengkap }}" placeholder="Enter Nama Lengkap"
                                                disabled>

                                            @error('nama_lengkap')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin"
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror" disabled>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option
                                                    value="Laki-Laki"{{ $data_pribadi->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                    Laki-Laki
                                                </option>
                                                <option
                                                    value="Perempuan"{{ $data_pribadi->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>

                                            @error('jenis_kelamin')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                name="tanggal_lahir"
                                                id="tanggal_lahir"value="{{ $data_pribadi->tanggal_lahir }}"
                                                placeholder="Enter Tanggal Lahir" disabled>

                                            @error('tanggal_lahir')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                name="tempat_lahir" id="tempat_lahir"
                                                value="{{ $data_pribadi->tempat_lahir }}" placeholder="Enter Tempat Lahir"
                                                disabled>

                                            @error('tempat_lahir')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="no_hp">No HP</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('no_hp') is-invalid @enderror"
                                                    name="no_hp" id="no_hp" value="{{ $data_pribadi->no_hp }}"
                                                    placeholder="0812 3456 7890" disabled>
                                            </div>

                                            @error('no_hp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">@</span>
                                                </div>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" value="{{ $data_pribadi->email }}"
                                                    placeholder="example@gmail.com" disabled>
                                            </div>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label for="alamat">Alamat</label>
                                            <input type="text"
                                                class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                                id="alamat" value="{{ $data_pribadi->alamat }}"
                                                placeholder="Enter Alamat" disabled>

                                            @error('alamat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                            <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                                class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                                disabled>
                                                <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                <option
                                                    value="SD"{{ $data_pribadi->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>
                                                    SD
                                                </option>
                                                <option
                                                    value="SMP"{{ $data_pribadi->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>
                                                    SMP
                                                </option>
                                                <option
                                                    value="SMA"{{ $data_pribadi->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>
                                                    SMA
                                                </option>
                                                <option
                                                    value="D3"{{ $data_pribadi->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>
                                                    D3
                                                </option>
                                                <option
                                                    value="S1"{{ $data_pribadi->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>
                                                    S1
                                                </option>
                                                <option
                                                    value="S2"{{ $data_pribadi->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>
                                                    S2
                                                </option>
                                            </select>

                                            @error('pendidikan_terakhir')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="agama">Agama</label>
                                            <select name="agama" id="agama"
                                                class="form-control @error('agama') is-invalid @enderror" disabled>
                                                <option value="">-- Pilih Agama --</option>
                                                <option
                                                    value="Islam"{{ $data_pribadi->agama == 'Islam' ? 'selected' : '' }}>
                                                    Islam
                                                </option>
                                                <option
                                                    value="Kristen"{{ $data_pribadi->agama == 'Kristen' ? 'selected' : '' }}>
                                                    Kristen
                                                </option>
                                                <option
                                                    value="Katolik"{{ $data_pribadi->agama == 'Katolik' ? 'selected' : '' }}>
                                                    Katolik
                                                </option>
                                                <option
                                                    value="Hindu"{{ $data_pribadi->agama == 'Hindu' ? 'selected' : '' }}>
                                                    Hindu
                                                </option>
                                                <option
                                                    value="Buddha"{{ $data_pribadi->agama == 'Buddha' ? 'selected' : '' }}>
                                                    Buddha
                                                </option>
                                                <option
                                                    value="Konghucu"{{ $data_pribadi->agama == 'Konghucu' ? 'selected' : '' }}>
                                                    Konghucu
                                                </option>
                                            </select>

                                            @error('agama')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="golongan_darah">Golongan Darah</label>
                                            <select name="golongan_darah" id="golongan_darah"
                                                class="form-control @error('golongan_darah') is-invalid @enderror"
                                                disabled>
                                                <option value="">-- Pilih Golongan Darah --</option>
                                                <option
                                                    value="A"{{ $data_pribadi->golongan_darah == 'A' ? 'selected' : '' }}>
                                                    A
                                                </option>
                                                <option
                                                    value="B"{{ $data_pribadi->golongan_darah == 'B' ? 'selected' : '' }}>
                                                    B
                                                </option>
                                                <option
                                                    value="AB"{{ $data_pribadi->golongan_darah == 'AB' ? 'selected' : '' }}>
                                                    AB
                                                </option>
                                                <option
                                                    value="O"{{ $data_pribadi->golongan_darah == 'O' ? 'selected' : '' }}>
                                                    O
                                                </option>
                                            </select>

                                            @error('golongan_darah')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="status_kawin">Status Kawin</label>
                                            <select name="status_kawin" id="status_kawin"
                                                class="form-control @error('status_kawin') is-invalid @enderror" disabled>
                                                <option value="">-- Pilih Status Kawin --</option>
                                                <option
                                                    value="TK"{{ $data_pribadi->status_kawin == 'TK' ? 'selected' : '' }}>
                                                    Tidak
                                                    Kawin
                                                </option>
                                                <option
                                                    value="K0"{{ $data_pribadi->status_kawin == 'K0' ? 'selected' : '' }}>
                                                    Kawin 0
                                                    Tanggungan
                                                </option>
                                                <option
                                                    value="K1"{{ $data_pribadi->status_kawin == 'K1' ? 'selected' : '' }}>
                                                    Kawin 1
                                                    Tanggungan
                                                </option>
                                                <option
                                                    value="K2"{{ $data_pribadi->status_kawin == 'K2' ? 'selected' : '' }}>
                                                    Kawin 2
                                                    Tanggungan
                                                </option>
                                                <option
                                                    value="K3"{{ $data_pribadi->status_kawin == 'K3' ? 'selected' : '' }}>
                                                    Kawin 3
                                                    Tanggungan
                                                </option>
                                            </select>

                                            @error('status_kawin')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                            <label for="tanggal_nikah">Tanggal Nikah</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_nikah') is-invalid @enderror"
                                                name="tanggal_nikah"
                                                id="tanggal_nikah"value="{{ $data_pribadi->tanggal_nikah }}"
                                                placeholder="Enter Tanggal nikah" disabled>

                                            @error('tanggal_nikah')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                            <label for="buku_nikah">Buku Nikah</label>
                                            <input type="file"
                                                class="form-control @error('buku_nikah') is-invalid @enderror"
                                                id="buku_nikah" name="buku_nikah"
                                                value="{{ $data_pribadi->buku_nikah }}" onchange="PratinjauGambar()"
                                                placeholder="Enter Buku Nikah" disabled>
                                            @if (!$errors->has('buku_nikah'))
                                                {{-- <div class="mb-2"> --}}
                                                <p>*Ukuran File Tidak Boleh Lebih Dari 800 KB | Harus .jpg, .jpeg, atau
                                                    .png</p>
                                                {{-- </div> --}}
                                            @endif

                                            @error('buku_nikah')
                                                <div class="text-danger mb-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                                    @if ($data_pribadi->buku_nikah == '-' || $data_pribadi->buku_nikah == null)
                                        <img src="{{ asset('storage/Logo/PTSU.png') }}"
                                            class="pratinjau-gambar img-fluid" alt=""
                                            style="max-height: 300px; max-width: 100%;">
                                    @else
                                        <img src="{{ asset('storage/BukuNikah/' . $data_pribadi->buku_nikah) }}"
                                            class="pratinjau-gambar img-fluid" alt=""
                                            style="max-height: 300px; max-width: 100%;">
                                    @endif
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="nik_pribadi">NIK</label>

                                    <input type="text" class="form-control @error('nik_pribadi') is-invalid @enderror"
                                        name="nik_pribadi" id="nik_pribadi"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('nik_pribadi') }}" @else value="{{ $data_pribadi->nik }}" @endif
                                        pattern="[0-9]+" title="Masukkan hanya angka" placeholder="Enter NIK"
                                        @disabled($data_pribadi->status_isi == '1')>

                                    @error('nik_pribadi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="ktp">KTP</label>
                                    <input type="file" class="form-control @error('ktp') is-invalid @enderror"
                                        id="ktp" name="ktp"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('ktp') }}"
                                        @else value="{{ $data_pribadi->ktp }}" @endif
                                        placeholder="Enter KTP" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('ktp'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('ktp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="rekening">Rekening</label>
                                    <small class="text-muted">(Kosongkan Jika Tidak Ada)</small>
                                    <input type="file" class="form-control @error('rekening') is-invalid @enderror"
                                        id="rekening" name="rekening"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('rekening') }}"
                                        @else value="{{ $data_pribadi->rekening }}" @endif
                                        placeholder="Enter Rekening" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('rekening'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('rekening')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="sim">SIM</label>
                                    <small class="text-muted">(Semua SIM Yang Ada Dijadikan 1 | Kosongkan Jika Tidak
                                        Ada)</small>
                                    <input type="file" class="form-control @error('sim') is-invalid @enderror"
                                        id="sim" name="sim"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('sim') }}" @else value="{{ $data_pribadi->sim }}" @endif
                                        placeholder="Enter SIM" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('sim'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('sim')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="kk">Kartu Keluarga</label>
                                    <input type="file" class="form-control @error('kk') is-invalid @enderror"
                                        id="kk" name="kk"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('kk') }}" @else value="{{ $data_pribadi->kk }}" @endif
                                        placeholder="Enter Kartu Keluarga" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('kk'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('kk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="bpjs_ketenagakerjaan">BPJS Ketenagakerjaan</label>
                                    <small class="text-muted">(Kosongkan Jika Tidak Ada)</small>
                                    <input type="file"
                                        class="form-control @error('bpjs_ketenagakerjaan') is-invalid @enderror"
                                        id="bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('bpjs_ketenagakerjaan') }}" @else value="{{ $data_pribadi->bpjs_ketenagakerjaan }}" @endif
                                        placeholder="Enter BPJS Ketenagakerjaan" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('bpjs_ketenagakerjaan'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('bpjs_ketenagakerjaan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="bpjs_kesehatan">BPJS Kesehatan</label>
                                    <small class="text-muted">(Kosongkan Jika Tidak Ada)</small>
                                    <input type="file"
                                        class="form-control @error('bpjs_kesehatan') is-invalid @enderror"
                                        id="bpjs_kesehatan" name="bpjs_kesehatan"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('bpjs_kesehatan') }}" @else value="{{ $data_pribadi->bpjs_kesehatan }}" @endif
                                        placeholder="Enter BPJS Kesehatan" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('bpjs_kesehatan'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('bpjs_kesehatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="npwp">NPWP</label>
                                    <small class="text-muted">(Kosongkan Jika Tidak Ada)</small>
                                    <input type="file" class="form-control @error('npwp') is-invalid @enderror"
                                        id="npwp" name="npwp"
                                        @if ($data_pribadi->status_isi == '0') value="{{ old('npwp') }}" @else value="{{ $data_pribadi->npwp }}" @endif
                                        placeholder="Enter NPWP" @disabled($data_pribadi->status_isi == '1')>
                                    @if (!$errors->has('npwp'))
                                        <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                    @endif

                                    @error('npwp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" required @disabled($data_pribadi->status_isi == '1')>
                                <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                        dengan
                                        kesadaran penuh bertanggung jawab atas keaslian data yang disimpan</small></label>
                            </div>
                            <div class="mb-4">
                                <p class="text-danger">*Semua file yang disimpan tidak dapat diubah, pastikan semua inputan
                                    sudah diisi dengan benar!</p>
                            </div>
                            <div class="mt-2">
                                {{-- <button type="submit" class="btn btn-primary" name="status_isi" value="0">Tambah
                                    Data Lainnya</button> --}}
                                <button type="submit" class="btn btn-primary" name="status_isi" value="1"
                                    @disabled($data_pribadi->status_isi == '1')>Next</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- script pratinjaugambar --}}
    <script src="{{ asset('dist/js/pratinjaugambar.js') }}"></script>

    <script>
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>

    <script>
        // Function to toggle visibility of fields based on marital status
        function toggleMaritalFields() {
            var statusKawin = document.getElementById('status_kawin').value;
            var tanggalNikahField = document.getElementById('tanggal_nikah').closest('.form-group');
            var bukuNikahField = document.getElementById('buku_nikah').closest('.form-group');

            // Check if marital status is selected and not "Tidak Kawin"
            if (statusKawin && statusKawin !== 'TK') {
                tanggalNikahField.style.display = 'block';
                bukuNikahField.style.display = 'block';
                document.getElementById('tanggal_nikah').setAttribute('required', 'required');
                document.getElementById('buku_nikah').setAttribute('required', 'required');
            } else {
                tanggalNikahField.style.display = 'none';
                bukuNikahField.style.display = 'none';
                document.getElementById('tanggal_nikah').removeAttribute('required');
                document.getElementById('buku_nikah').removeAttribute('required');
            }
        }

        // Call the function initially to set the fields based on the current value of status_kawin
        toggleMaritalFields();

        // Add event listener to status_kawin field to toggle visibility of other fields
        document.getElementById('status_kawin').addEventListener('change', function() {
            toggleMaritalFields();
        });

        // Hide fields if marital status is not selected initially
        document.addEventListener('DOMContentLoaded', function() {
            toggleMaritalFields();
        });
    </script>

    @include('sweetalert::alert')

@endsection

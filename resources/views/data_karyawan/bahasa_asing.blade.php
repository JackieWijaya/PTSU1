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
            <h3 class="card-title">Bahasa Asing</h3>
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
                    <div class="step" data-target="#pengalaman-kerja">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pengalaman-kerja"
                            id="pengalaman-kerja-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">6</span>
                        </button>
                    </div>
                    <div class="step active" data-target="#bahasa-asing">
                        <button type="button" class="step-trigger" role="tab" aria-controls="bahasa-asing"
                            id="bahasa-asing-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">7</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="bahasa-asing" class="content active dstepper-block" role="tabpanel"
                        aria-labelledby="bahasa-asing-trigger">
                        <form action="{{ route('bahasa_asing.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                @if (!$bahasa_asing_status || $bahasa_asing_status->status_isi == '0')
                                    <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <label for="lisan">Lisan</label>
                                        <select name="lisan" id="lisan"
                                            class="form-control @error('lisan') is-invalid @enderror">
                                            <option value="">-- Pilih Nilai Keahlian --</option>
                                            <option value="Cukup"{{ old('lisan') == 'Cukup' ? 'selected' : '' }}>
                                                Cukup
                                            </option>
                                            <option value="Sedang"{{ old('lisan') == 'Sedang' ? 'selected' : '' }}>
                                                Sedang
                                            </option>
                                            <option value="Baik"{{ old('lisan') == 'Baik' ? 'selected' : '' }}>
                                                Baik
                                            </option>
                                        </select>

                                        @error('lisan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <label for="tulisan">Tulisan</label>
                                        <select name="tulisan" id="tulisan"
                                            class="form-control @error('tulisan') is-invalid @enderror">
                                            <option value="">-- Pilih Nilai Keahlian --</option>
                                            <option value="Cukup"{{ old('tulisan') == 'Cukup' ? 'selected' : '' }}>
                                                Cukup
                                            </option>
                                            <option value="Sedang"{{ old('tulisan') == 'Sedang' ? 'selected' : '' }}>
                                                Sedang
                                            </option>
                                            <option value="Baik"{{ old('tulisan') == 'Baik' ? 'selected' : '' }}>
                                                Baik
                                            </option>
                                        </select>

                                        @error('tulisan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    @foreach ($bahasa_asing as $item)
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label for="lisan">Lisan</label>
                                            <select name="lisan" id="lisan"
                                                class="form-control @error('lisan') is-invalid @enderror" disabled>
                                                <option value="">-- Pilih Nilai Keahlian --</option>
                                                <option value="Cukup"{{ $item->lisan == 'Cukup' ? 'selected' : '' }}>
                                                    Cukup
                                                </option>
                                                <option value="Sedang"{{ $item->lisan == 'Sedang' ? 'selected' : '' }}>
                                                    Sedang
                                                </option>
                                                <option value="Baik"{{ $item->lisan == 'Baik' ? 'selected' : '' }}>
                                                    Baik
                                                </option>
                                            </select>

                                            @error('lisan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label for="tulisan">Tulisan</label>
                                            <select name="tulisan" id="tulisan"
                                                class="form-control @error('tulisan') is-invalid @enderror" disabled>
                                                <option value="">-- Pilih Nilai Keahlian --</option>
                                                <option value="Cukup"{{ $item->tulisan == 'Cukup' ? 'selected' : '' }}>
                                                    Cukup
                                                </option>
                                                <option value="Sedang"{{ $item->tulisan == 'Sedang' ? 'selected' : '' }}>
                                                    Sedang
                                                </option>
                                                <option value="Baik"{{ $item->tulisan == 'Baik' ? 'selected' : '' }}>
                                                    Baik
                                                </option>
                                            </select>

                                            @error('tulisan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <hr class="mt-3">
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-check ml-1">
                                <input class="form-check-input" type="checkbox" id="checkbox"
                                    @disabled($bahasa_asing_status && $bahasa_asing_status->status_isi == '1')>
                                <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                        dengan kesadaran penuh bertanggung jawab atas keaslian data yang
                                        disimpan</small></label>
                            </div>
                            <div class="mb-4">
                                <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
                                    sudah diisi dengan benar!</p>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="status_isi" value="1"
                                    onclick="setRequired(true)" @disabled($bahasa_asing_status && $bahasa_asing_status->status_isi == '1')>Simpan</button>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#yakinModal" onclick="setRequired(false)"
                                    @disabled($bahasa_asing_status && $bahasa_asing_status->status_isi == '1')>Next</button> --}}
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

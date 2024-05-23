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

         .card-body.clone {
             transform: translateY(-10000px);
             /* Atur posisi card body clone */
         }
     </style>

     <div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Title</h3>
         </div>
         <div class="card-body p-0">
             <div class="bs-stepper linear">
                 <div class="bs-stepper-header" role="tablist">

                     <div class="step" data-target="#data-pribadi">
                         <button type="button" class="step-trigger" role="tab" aria-controls="data-pribadi"
                             id="data-pribadi-trigger" aria-selected="false" disabled="disabled">
                             <span class="bs-stepper-circle">1</span>
                             <span class="bs-stepper-label">Data Pribadi</span>
                         </button>
                     </div>
                     <div class="line"></div>
                     <div class="step active" data-target="#data-keluarga-inti">
                         <button type="button" class="step-trigger" role="tab" aria-controls="data-keluarga-inti"
                             id="data-keluarga-inti-trigger" aria-selected="true">
                             <span class="bs-stepper-circle">2</span>
                             <span class="bs-stepper-label">Data Keluarga Inti</span>
                         </button>
                     </div>
                 </div>
                 <div class="bs-stepper-content">
                     <div id="data-keluarga-inti" class="content active dstepper-block" role="tabpanel"
                         aria-labelledby="data-keluarga-inti-trigger">
                         <div class="row">
                             <input type="hidden" class="form-control @error('id') is-invalid @enderror" name="id"
                                 id="id" value="{{ $data_pribadi->id }}" placeholder="Enter ID">

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="nik_inti">NIK</label>
                                 <input type="text" class="form-control @error('nik_inti') is-invalid @enderror"
                                     name="nik_inti" id="nik_inti" value="{{ old('nik_inti') }}" placeholder="Enter NIK">

                                 @error('nik_inti')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="status_keluarga_inti">Status Keluarga</label>
                                 <input type="text"
                                     class="form-control @error('status_keluarga_inti') is-invalid @enderror"
                                     name="status_keluarga_inti" id="status_keluarga_inti"
                                     value="{{ old('status_keluarga_inti') }}"
                                     placeholder="Enter Istri / Suami / Anak 1-10">

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
                                     placeholder="Enter Nama Anggota Keluarga">

                                 @error('nama_anggota_keluarga_inti')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="ktp_pasangan">KTP Pasangan</label>
                                 <input type="file" class="form-control @error('ktp_pasangan') is-invalid @enderror"
                                     id="ktp_pasangan" name="ktp_pasangan" value="{{ old('ktp_pasangan') }}"
                                     placeholder="Enter KTP Pasangan">
                                 @if (!$errors->has('ktp_pasangan'))
                                     <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                                 @endif

                                 @error('ktp_pasangan')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="tempat_lahir_inti">Tempat Lahir</label>
                                 <input type="text" class="form-control @error('tempat_lahir_inti') is-invalid @enderror"
                                     name="tempat_lahir_inti" id="tempat_lahir_inti" value="{{ old('tempat_lahir_inti') }}"
                                     placeholder="Enter Tempat Lahir">

                                 @error('tempat_lahir_inti')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="tanggal_lahir_inti">Tanggal Lahir</label>
                                 <input type="date"
                                     class="form-control @error('tanggal_lahir_inti') is-invalid @enderror"
                                     name="tanggal_lahir_inti"
                                     id="tanggal_lahir_inti"value="{{ old('tanggal_lahir_inti') }}"
                                     placeholder="Enter Tanggal Lahir">

                                 @error('tanggal_lahir_inti')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="pendidikan_inti">Pendidikan</label>
                                 <input type="text" class="form-control @error('pendidikan_inti') is-invalid @enderror"
                                     name="pendidikan_inti" id="pendidikan_inti" value="{{ old('pendidikan_inti') }}"
                                     placeholder="Enter SD / SMP / SMA / D3 / S1 / S2">

                                 @error('pendidikan_inti')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                 <label for="pekerjaan_inti">Pekerjaan</label>
                                 <input type="text" class="form-control @error('pekerjaan_inti') is-invalid @enderror"
                                     name="pekerjaan_inti" id="pekerjaan_inti" value="{{ old('pekerjaan_inti') }}"
                                     placeholder="Enter Pekerjaan">

                                 @error('pekerjaan_inti')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>
                         </div>
                         <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                         <button type="submit" class="btn btn-primary">Submit</button>
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

     @include('sweetalert::alert')

 @endsection

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

                    <div class="step active" data-target="#data-pribadi">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-pribadi"
                            id="data-pribadi-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">Data Pribadi</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#data-keluarga-inti">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-keluarga-inti"
                            id="data-keluarga-inti-trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Data Keluarga Inti</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    @include('data_karyawan.data_pribadi')
                    @include('data_karyawan.data_keluarga_inti')
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

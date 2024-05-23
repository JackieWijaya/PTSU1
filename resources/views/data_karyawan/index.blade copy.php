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

    <form action="{{ route('data_karyawan.update', ['data_karyawan' => $data_pribadi->id]) }}" method="POST"
        enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <input type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" id="id"
            value="{{ $data_pribadi->id }}" placeholder="Enter ID">

        @include('data_karyawan.data_pribadi')
        @include('data_karyawan.data_keluarga_inti')
        @include('data_karyawan.data_keluarga_kandung')
        @include('data_karyawan.data_pendidikan')
        @include('data_karyawan.pelatihan_sertifikat')
        @include('data_karyawan.pengalaman_kerja')
        @include('data_karyawan.bahasa_asing')

        <div class="form-check ml-1">
            <input class="form-check-input" type="checkbox" required>
            <label class="form-check-label">Dengan melakukan centang anda dengan
                kesadaran penuh bertanggung jawab atas keaslian data yang disimpan</label>
        </div>
        <div class="mb-4">
            <p class="text-danger">*Semua file yang disimpan tidak dapat diubah!</p>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Simpan</button>

    </form>

    {{-- script pratinjaugambar --}}
    <script src="{{ asset('dist/js/pratinjaugambar.js') }}"></script>

    <script>
        document.getElementById('buku_nikah').addEventListener('change', function(e) {
            var fileName = document.getElementById("buku_nikah").files[0].name;
            var label = document.getElementById("fileLabel");
            label.innerHTML = fileName;
        });
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
            } else {
                tanggalNikahField.style.display = 'none';
                bukuNikahField.style.display = 'none';
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Restore cloned card body data from session storage if available
            var clonedData = sessionStorage.getItem('cloned_data');
            if (clonedData) {
                var clonedCardData = JSON.parse(clonedData);
                clonedCardData.forEach(function(data) {
                    var clonedCardBody = document.getElementById(data.id);
                    var inputFields = clonedCardBody.querySelectorAll('input, select, textarea');
                    inputFields.forEach(function(input) {
                        input.value = data[input.name];
                    });
                });
            }
        });

        function copyCardBody(cardBodyId) {
            var originalCardBody = document.getElementById(cardBodyId);
            var clonedCardBody = originalCardBody.cloneNode(true); // Clone the original card body
            var newCardBodyId = cardBodyId + '_copy'; // Generate a new ID for the cloned card body
            clonedCardBody.id = newCardBodyId; // Assign the new ID to the cloned card body

            // Clear input values in the cloned card body
            var inputFields = clonedCardBody.querySelectorAll('input, select, textarea');
            inputFields.forEach(function(input) {
                input.value = '';
            });

            // Store cloned card body data in session storage
            var clonedCardData = getCardData(clonedCardBody);
            var storedData = sessionStorage.getItem('cloned_data');
            var dataToStore = storedData ? JSON.parse(storedData) : [];
            dataToStore.push(clonedCardData);
            sessionStorage.setItem('cloned_data', JSON.stringify(dataToStore));

            // Create a hidden input field to store cloned card body ID
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'cloned_ids[]'; // Change 'cloned_ids' to match your backend naming convention
            hiddenInput.value = newCardBodyId;
            clonedCardBody.appendChild(hiddenInput);

            // Create a horizontal rule element
            var hr = document.createElement('hr');

            // Append the horizontal rule and cloned card body after the original card body
            originalCardBody.parentNode.appendChild(hr);
            originalCardBody.parentNode.appendChild(clonedCardBody);
        }

        // Function to get data from card body
        function getCardData(cardBody) {
            var formData = {
                id: cardBody.id
            }; // Include card body ID in the data
            var inputFields = cardBody.querySelectorAll('input, select, textarea');
            inputFields.forEach(function(input) {
                formData[input.name] = input.value;
            });
            return formData;
        }
    </script>

    @include('sweetalert::alert')

@endsection

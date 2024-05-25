@extends('layout.master')

@section('title', 'Data Karyawan')

@section('content')

    {{-- @if ($bahasa_asing && $bahasa_asing->status_isi == '1') --}}
    @if ($data_pribadi && $data_pribadi->status_isi == '1')
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills bg-white d-flex m-0" id="tab-menu">
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link active text-center" href="#tab_1" data-toggle="tab">Data Pribadi</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_2" data-toggle="tab">Data Keluarga Inti</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_3" data-toggle="tab">Data Keluarga Kandung</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_4" data-toggle="tab">Data Pendidikan</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_5" data-toggle="tab">Sertifikat Pelatihan</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_6" data-toggle="tab">Pengalaman Kerja</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_7" data-toggle="tab">Bahasa Asing</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="tab-content">
            <div class="tab-pane active" id="tab_1">@include('data_karyawan.tab_1')</div>
            <div class="tab-pane" id="tab_2">Content for Data Keluarga Inti</div>
            <div class="tab-pane" id="tab_3">Content for Data Keluarga Kandung</div>
            <div class="tab-pane" id="tab_4">Content for Data Pendidikan</div>
            <div class="tab-pane" id="tab_5">Content for Sertifikat Pelatihan</div>
            <div class="tab-pane" id="tab_6">Content for Pengalaman Kerja</div>
            <div class="tab-pane" id="tab_7">Content for Bahasa Asing</div>
        </div>
    @else
        @include('data_karyawan.data_pribadi')
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabMenu = document.getElementById('tab-menu');
            const tabContent = document.getElementById('tab-content');

            tabMenu.querySelectorAll('.nav-link').forEach(function(tabLink) {
                tabLink.addEventListener('click', function(event) {
                    event.preventDefault(); // Menghentikan perilaku default dari link

                    // Hapus class active dari semua tab dan konten
                    tabMenu.querySelectorAll('.nav-link').forEach(function(link) {
                        link.classList.remove('active');
                    });
                    tabContent.querySelectorAll('.tab-pane').forEach(function(tab) {
                        tab.classList.remove('active');
                    });

                    // Tambahkan class active ke tab dan konten yang dipilih
                    tabLink.classList.add('active');
                    const target = document.querySelector(tabLink.getAttribute('href'));
                    target.classList.add('active');
                });
            });
        });
    </script>

@endsection

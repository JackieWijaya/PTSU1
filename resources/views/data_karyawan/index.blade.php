@extends('layout.master')

@section('title', 'Data Karyawan')

@section('content')
    <style>
        #data-center td,
        #data-center th {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    @if (Auth::user()->role == 'HRD')
        @include('data_karyawan.all_data')
    @else
        @if ($bahasa_asing && $bahasa_asing->status_isi == '1')
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills bg-white d-flex m-0" id="tab-menu">
                        <li class="nav-item flex-fill custom-tab">
                            <a class="nav-link active text-center" href="#tab_1" data-toggle="tab">Data Pribadi</a>
                        </li>
                        @if ($data_pribadi->status_kawin != 'TK')
                            <li class="nav-item flex-fill custom-tab">
                                <a class="nav-link text-center" href="#tab_2" data-toggle="tab">Data Keluarga Inti</a>
                            </li>
                        @endif
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
                <div class="tab-pane" id="tab_2">@include('data_karyawan.tab_2')</div>
                <div class="tab-pane" id="tab_3">@include('data_karyawan.tab_3')</div>
                <div class="tab-pane" id="tab_4">@include('data_karyawan.tab_4')</div>
                <div class="tab-pane" id="tab_5">@include('data_karyawan.tab_5')</div>
                <div class="tab-pane" id="tab_6">@include('data_karyawan.tab_6')</div>
                <div class="tab-pane" id="tab_7">
                    <div class="card" id="data-center">
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nilai Keahlian Lisan</th>
                                        <th>Nilai Keahlian Tulisan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($bahasa_asing)
                                        <tr>
                                            <td>{{ $bahasa_asing->lisan }}</td>
                                            <td>{{ $bahasa_asing->tulisan }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="2">Belum Ada Data / User Belum Melakukan Input Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include('data_karyawan.data_pribadi')
        @endif
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

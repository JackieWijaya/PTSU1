@extends('layout.master')

@section('title', 'Data Pelamar')

@section('content')
    <style>
        td,
        th {
            text-align: center;
        }
    </style>

    @php
        $no = 1;
    @endphp

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Info</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Tanggal Lamar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pribadis as $item)
                        <tr>
                            {{-- @dd($item); --}}
                            <td>{{ $no++ }}</td>
                            <td>
                                <button id="info" class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoModal"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}"
                                    data-no="{{ $item->no_hp }}" data-email="{{ $item->email }}"
                                    data-tgllahir="{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}"
                                    data-tmptlahir="{{ $item->tempat_lahir }}" data-jk="{{ $item->jenis_kelamin }}"
                                    data-alamat="{{ $item->alamat }}" data-pendidikan="{{ $item->pendidikan_terakhir }}"
                                    data-agama="{{ $item->agama }}" data-goldar="{{ $item->golongan_darah }}"
                                    data-statuskawin="{{ $item->status_kawin }}"
                                    data-tglnikah="{{ \Carbon\Carbon::parse($item->tanggal_nikah)->format('d F Y') }}"
                                    data-bukunikah="{{ $item->buku_nikah }}"
                                    data-tgllamar="{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}"
                                    data-status="{{ $item->status }}"><i class="bi bi-info-circle"></i></button>
                            </td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</td>
                            <td>{{ $item->pendidikan_terakhir }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <form action="{{ route('data_pelamar.update', [$item->id]) }}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        @if ($item->status == null)
                                            <button class="btn btn-sm btn-success" type="submit" id="btn-wa"
                                                name="status" value="Diterima">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" type="submit" name="status"
                                                value="Ditolak">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        @else
                                            @if ($item->status == 'Diterima')
                                                <small class="badge badge-success">Diterima</small>
                                            @else
                                                <small class="badge badge-danger">Ditolak</small>
                                            @endif
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal fade" id="infoModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Pelamar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p><strong>ID</strong><br><span id="id"></span></p>
                            <p><strong>Nama Lengkap</strong><br><span id="nama_lengkap"></span></p>
                            <p><strong>No HP</strong><br><span id="no_hp"></span></p>
                            <p><strong>Email</strong><br><span id="email"></span></p>
                            <p><strong>Tanggal Lahir</strong><br><span id="tanggal_lahir"></span></p>
                            <p><strong>Tempat Lahir</strong><br><span id="tempat_lahir"></span></p>
                            <p><strong>Jenis Kelamin</strong><br><span id="jenis_kelamin"></span></p>
                            <p><strong>Alamat</strong><br><span id="alamat"></span></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Pendidikan Terakhir</strong><br><span id="pendidikan_terakhir"></span></p>
                            <p><strong>Agama</strong><br><span id="agama"></span></p>
                            <p><strong>Gol Darah</strong><br><span id="golongan_darah"></span></p>
                            <p><strong>Status Kawin</strong><br><span id="status_kawin"></span></p>
                            <p><strong>Tanggal Nikah</strong><br><span id="tanggal_nikah"></span></p>
                            <p><strong>Buku Nikah</strong><br><span id="buku_nikah"></span></p>
                            <p><strong>Tanggal Lamar</strong><br><span id="tanggal_lamar"></span></p>
                            <p><strong>Status</strong><br><span id="status"></span></p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#info', function() {
                let id = $(this).attr('data-id');
                let nama_lengkap = $(this).attr('data-nama');
                let no_hp = $(this).attr('data-no');
                let email = $(this).attr('data-email');
                let tanggal_lahir = $(this).attr('data-tgllahir');
                let tempat_lahir = $(this).attr('data-tmptlahir');
                let jenis_kelamin = $(this).attr('data-jk');
                let alamat = $(this).attr('data-alamat');
                let pendidikan_terakhir = $(this).attr('data-pendidikan');
                let agama = $(this).attr('data-agama');
                let golongan_darah = $(this).attr('data-goldar');
                let status_kawin = $(this).attr('data-statuskawin');
                let tanggal_nikah = $(this).attr('data-tglnikah');
                let buku_nikah = $(this).attr('data-bukunikah');
                let tanggal_lamar = $(this).attr('data-tgllamar');
                let status = $(this).attr('data-status');

                // let jenis_kelamin_text;
                // switch (jenis_kelamin) {
                //     case 'laki-laki':
                //         jenis_kelamin_text = 'Laki-Laki';
                //         break;
                //     case 'perempuan':
                //         jenis_kelamin_text = 'Perempuan';
                //         break;
                //     default:
                //         jenis_kelamin_text = '-';
                //         break;
                // }

                // Mengonversi status kawin menjadi teks yang sesuai
                let status_kawin_text;
                switch (status_kawin) {
                    case 'TK':
                        status_kawin_text = 'Tidak Kawin';
                        break;
                    case 'K0':
                        status_kawin_text = 'Kawin 0 Tanggungan';
                        break;
                    case 'K1':
                        status_kawin_text = 'Kawin 1 Tanggungan';
                        break;
                    case 'K2':
                        status_kawin_text = 'Kawin 2 Tanggungan';
                        break;
                    case 'K3':
                        status_kawin_text = 'Kawin 3 Tanggungan';
                        break;
                    default:
                        status_kawin_text = '-';
                        break;
                }

                console.log(buku_nikah);
                let buku_nikah_text;
                if (buku_nikah === '-' || buku_nikah === '') {
                    buku_nikah_text = '-';
                } else {
                    // Jika buku nikah bukan "-"
                    buku_nikah_text =
                        `<a href="/storage/BukuNikah/${buku_nikah}">Lihat</a>`;
                }

                // Menetapkan status teks dan tampilannya berdasarkan nilai status
                let status_text;
                let status_badge_class;
                switch (status) {
                    case 'Diterima':
                        status_text = 'Diterima';
                        status_badge_class = 'badge badge-success';
                        break;
                    case 'Ditolak':
                        status_text = 'Ditolak';
                        status_badge_class = 'badge badge-danger';
                        break;
                    default:
                        status_text = 'Menunggu';
                        status_badge_class = 'badge badge-secondary';
                        break;
                }

                // Menetapkan nilai ke elemen HTML
                $('#id').text(id);
                $('#nama_lengkap').text(nama_lengkap);
                $('#no_hp').text(no_hp);
                $('#email').text(email);
                $('#tanggal_lahir').text(tanggal_lahir);
                $('#tempat_lahir').text(tempat_lahir);
                $('#jenis_kelamin').text(jenis_kelamin);
                $('#alamat').text(alamat);
                $('#pendidikan_terakhir').text(pendidikan_terakhir);
                $('#agama').text(agama);
                $('#golongan_darah').text(golongan_darah);
                $('#status_kawin').text(status_kawin_text);
                $('#tanggal_nikah').text(tanggal_nikah ? tanggal_nikah : '-');
                $('#buku_nikah').html(buku_nikah_text); // Menggunakan html() untuk memasukkan tautan
                $('#tanggal_lamar').text(tanggal_lamar);
                // Menghapus kelas dan menetapkan kelas baru
                $('#status').removeClass().addClass(status_badge_class).text(status_text);
            })
        })
    </script>
@endsection

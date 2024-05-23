<div class="card card-primary" id="card3">
    <div class="card-header d-flex justify-content">
        <h3 class="card-title mb-0 mr-2">Data Pendidikan</h3>
        <button type="button" class="btn btn-xs btn-secondary" onclick="copyCardBody('cardBody3')">
            <i class="fas fa-plus"> Tambah Data Lainnya</i>
        </button>
    </div>

    <div class="card-body" id="cardBody3">

        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="jenjang">Jenjang</label>
                <input type="text" class="form-control @error('jenjang') is-invalid @enderror" name="jenjang"
                    id="jenjang" value="{{ old('jenjang') }}" placeholder="Enter SD / SMP / SMA / D3 / S1 / S2">

                @error('jenjang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="fakultas">Fakultas</label>
                {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP/SMA)</small> --}}
                <input type="text" class="form-control @error('fakultas') is-invalid @enderror" name="fakultas"
                    id="fakultas" value="{{ old('fakultas') }}" placeholder="Enter Fakultas">
                @if (!$errors->has('fakultas'))
                    <p>*Input "-" Jika Jenjang SD/SMP/SMA</p>
                @endif

                @error('fakultas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="nama_sekolah">Nama Sekolah</label>
                <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                    name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah') }}"
                    placeholder="Enter Nama Sekolah">

                @error('nama_sekolah')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="jurusan">Jurusan</label>
                {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP)</small> --}}
                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan"
                    id="jurusan" value="{{ old('jurusan') }}" placeholder="Enter Jurusan">
                @if (!$errors->has('jurusan'))
                    <p>*Input "-" Jika Jenjang SD/SMP</p>
                @endif

                @error('jurusan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="tahun_masuk">Tahun Masuk</label>
                <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" name="tahun_masuk"
                    id="tahun_masuk" value="{{ old('tahun_masuk') }}" placeholder="Enter Tahun Masuk">

                @error('tahun_masuk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="tahun_lulus">Tahun Lulus</label>
                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus"
                    id="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Enter Tahun Lulus">

                @error('tahun_lulus')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>

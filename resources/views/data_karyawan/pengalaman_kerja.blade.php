<div class="card card-primary" id="card5">
    <div class="card-header d-flex justify-content">
        <h3 class="card-title mb-0 mr-2">Pengalaman Kerja</h3>
        <button type="button" class="btn btn-xs btn-secondary" onclick="copyCardBody('cardBody5')">
            <i class="fas fa-plus"> Tambah Data Lainnya</i>
        </button>
    </div>

    <div class="card-body" id="cardBody5">

        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="nama_perusahaan">Nama Perusahaan</label>
                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                    name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                    placeholder="Enter Nama Perusahaan">

                @error('nama_perusahaan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                    id="jabatan" value="{{ old('jabatan') }}" placeholder="Enter Jabatan">

                @error('jabatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="mulai_kerja">Tanggal Mulai</label>
                <input type="date" class="form-control @error('mulai_kerja') is-invalid @enderror" name="mulai_kerja"
                    id="mulai_kerja"value="{{ old('mulai_kerja') }}" placeholder="Enter Mulai">

                @error('mulai_kerja')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="akhir_kerja">Tanggal Akhir</label>
                <input type="date" class="form-control @error('akhir_kerja') is-invalid @enderror" name="akhir_kerja"
                    id="akhir_kerja"value="{{ old('akhir_kerja') }}" placeholder="Enter Akhir">

                @error('akhir_kerja')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="gaji">Gaji</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i>Rp.</i></span>
                    </div>
                    <input type="text" class="form-control @error('gaji') is-invalid @enderror" name="gaji"
                        id="gaji" value="{{ old('gaji') }}" pattern="[0-9]+" title="Masukkan hanya angka"
                        placeholder="1234567890">
                </div>

                @error('gaji')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="alasan_keluar">Alasan Keluar</label>
                <input type="text" class="form-control @error('alasan_keluar') is-invalid @enderror"
                    name="alasan_keluar" id="alasan_keluar" value="{{ old('alasan_keluar') }}"
                    placeholder="Enter Alasan Keluar">

                @error('alasan_keluar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>

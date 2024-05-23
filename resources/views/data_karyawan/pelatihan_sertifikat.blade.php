<div class="card card-primary" id="card4">
    <div class="card-header d-flex justify-content">
        <h3 class="card-title mb-0 mr-2">Sertifikat Pelatihan</h3>
        <button type="button" class="btn btn-xs btn-secondary" onclick="copyCardBody('cardBody4')">
            <i class="fas fa-plus"> Tambah Data Lainnya</i>
        </button>
    </div>

    <div class="card-body" id="cardBody4">

        <div class="row">
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="nama_lembaga">Nama Lembaga</label>
                <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror"
                    name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga') }}"
                    placeholder="Enter Nama Lembaga">

                @error('nama_lembaga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                    id="jenis" value="{{ old('jenis') }}" placeholder="Enter Jenis">
                @if (!$errors->has('jenis'))
                    <p>*Pelatihan/Lomba/Seminar/Dll</p>
                @endif

                @error('jenis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="mulai_pelatihan">Tanggal Mulai</label>
                <input type="date" class="form-control @error('mulai_pelatihan') is-invalid @enderror"
                    name="mulai_pelatihan" id="mulai_pelatihan"value="{{ old('mulai_pelatihan') }}"
                    placeholder="Enter Mulai">

                @error('mulai_pelatihan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="akhir_pelatihan">Tanggal Akhir</label>
                <input type="date" class="form-control @error('akhir_pelatihan') is-invalid @enderror"
                    name="akhir_pelatihan" id="akhir_pelatihan"value="{{ old('akhir_pelatihan') }}"
                    placeholder="Enter Akhir">

                @error('akhir_pelatihan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>

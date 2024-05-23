<div class="card card-primary" id="card2">
    <div class="card-header d-flex justify-content">
        <h3 class="card-title mb-0 mr-2">Data Keluarga Kandung</h3>
        <button type="button" class="btn btn-xs btn-secondary" onclick="copyCardBody('cardBody2')">
            <i class="fas fa-plus"> Tambah Data Lainnya</i>
        </button>
    </div>

    <div class="card-body" id="cardBody2">

        <div class="row">
            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="status_keluarga_kandung">Status Keluarga</label>
                <input type="text" class="form-control @error('status_keluarga_kandung') is-invalid @enderror"
                    name="status_keluarga_kandung" id="status_keluarga_kandung"
                    value="{{ old('status_keluarga_kandung') }}" placeholder="Enter Status Keluarga">
                @if (!$errors->has('status_keluarga_kandung'))
                    <p>*Ayah atau Ibu Kandung/Ayah atau Ibu Mertua/Saudara 1-10</p>
                @endif

                @error('status_keluarga_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="nama_anggota_keluarga_kandung">Nama Anggota Keluarga</label>
                <input type="text" class="form-control @error('nama_anggota_keluarga_kandung') is-invalid @enderror"
                    name="nama_anggota_keluarga_kandung" id="nama_anggota_keluarga_kandung"
                    value="{{ old('nama_anggota_keluarga_kandung') }}" placeholder="Enter Nama Anggota Keluarga">

                @error('nama_anggota_keluarga_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="jenis_kelamin_kandung">Jenis Kelamin</label>
                <select name="jenis_kelamin_kandung" id="jenis_kelamin_kandung"
                    class="form-control @error('jenis_kelamin_kandung') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="laki-laki"{{ old('jenis_kelamin_kandung') == 'laki-laki' ? 'selected' : '' }}>
                        Laki-Laki
                    </option>
                    <option value="perempuan"{{ old('jenis_kelamin_kandung') == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>

                @error('jenis_kelamin_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="tempat_lahir_kandung">Tempat Lahir</label>
                <input type="text" class="form-control @error('tempat_lahir_kandung') is-invalid @enderror"
                    name="tempat_lahir_kandung" id="tempat_lahir_kandung" value="{{ old('tempat_lahir_kandung') }}"
                    placeholder="Enter Tempat Lahir">

                @error('tempat_lahir_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-4 col-sm-12">
                <label for="tanggal_lahir_kandung">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir_kandung') is-invalid @enderror"
                    name="tanggal_lahir_kandung" id="tanggal_lahir_kandung"value="{{ old('tanggal_lahir_kandung') }}"
                    placeholder="Enter Tanggal Lahir">

                @error('tanggal_lahir_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-4 col-sm-12">
                <label for="pendidikan_kandung">Pendidikan</label>
                <input type="text" class="form-control @error('pendidikan_kandung') is-invalid @enderror"
                    name="pendidikan_kandung" id="pendidikan_kandung" value="{{ old('pendidikan_kandung') }}"
                    placeholder="Enter SD / SMP / SMA / D3 / S1 / S2">

                @error('pendidikan_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-4 col-sm-12">
                <label for="pekerjaan_kandung">Pekerjaan</label>
                <input type="text" class="form-control @error('pekerjaan_kandung') is-invalid @enderror"
                    name="pekerjaan_kandung" id="pekerjaan_kandung" value="{{ old('pekerjaan_kandung') }}"
                    placeholder="Enter Pekerjaan">

                @error('pekerjaan_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('status_keluarga').addEventListener('input', function() {
        var statusKeluarga = this.value.toLowerCase();
        var jenisKelaminField = document.getElementById('jenis_kelamin');

        // Jika status keluarga mengandung kata "ayah" atau "ayah", jenis kelamin otomatis laki-laki
        if (statusKeluarga.includes('ayah')) {
            jenisKelaminField.value = 'laki-laki';
        }
        // Jika status keluarga mengandung kata "ibu" atau "ibu", jenis kelamin otomatis perempuan
        else if (statusKeluarga.includes('ibu')) {
            jenisKelaminField.value = 'perempuan';
        }
    });
</script>

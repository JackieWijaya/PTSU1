<div class="card card-primary">
    <div class="card-header text-center">
        <h4 class="card-title text-center">Bahasa Asing</h3>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                <label for="lisan">Lisan</label>
                <select name="lisan" id="lisan" class="form-control @error('lisan') is-invalid @enderror">
                    <option value="">-- Pilih Nilai Keahlian --</option>
                    <option value="Cukup"{{ old('lisan') == 'Cukup' ? 'selected' : '' }}>
                        Cukup
                    </option>
                    <option value="Sedang"{{ old('lisan') == 'Sedang' ? 'selected' : '' }}>
                        Sedang
                    </option>
                    <option value="Baik"{{ old('lisan') == 'Baik' ? 'selected' : '' }}>
                        Baik
                    </option>
                </select>

                @error('lisan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                <label for="tulisan">Tulisan</label>
                <select name="tulisan" id="tulisan" class="form-control @error('tulisan') is-invalid @enderror">
                    <option value="">-- Pilih Nilai Keahlian --</option>
                    <option value="Cukup"{{ old('tulisan') == 'Cukup' ? 'selected' : '' }}>
                        Cukup
                    </option>
                    <option value="Sedang"{{ old('tulisan') == 'Sedang' ? 'selected' : '' }}>
                        Sedang
                    </option>
                    <option value="Baik"{{ old('tulisan') == 'Baik' ? 'selected' : '' }}>
                        Baik
                    </option>
                </select>

                @error('tulisan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>

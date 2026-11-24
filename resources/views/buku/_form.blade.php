<div class="form-grid">
    <div class="form-field form-field-wide">
        <label for="judul">Nama buku <span class="required-mark">*</span></label>
        <input
            id="judul"
            name="judul"
            type="text"
            value="{{ old('judul', $buku['judul'] ?? '') }}"
            placeholder="Contoh: Laskar Pelangi"
            maxlength="150"
            required
            autofocus
            @error('judul') aria-invalid="true" aria-describedby="judul-error" @enderror
        >
        @error('judul')
            <span class="field-error" id="judul-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-field">
        <label for="penulis">Penulis <span class="required-mark">*</span></label>
        <input
            id="penulis"
            name="penulis"
            type="text"
            value="{{ old('penulis', $buku['penulis'] ?? '') }}"
            placeholder="Nama penulis"
            maxlength="100"
            required
            @error('penulis') aria-invalid="true" aria-describedby="penulis-error" @enderror
        >
        @error('penulis')
            <span class="field-error" id="penulis-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-field">
        <label for="kategori">Kategori <span class="required-mark">*</span></label>
        <input
            id="kategori"
            name="kategori"
            type="text"
            value="{{ old('kategori', $buku['kategori'] ?? '') }}"
            placeholder="Contoh: Fiksi"
            maxlength="60"
            required
            @error('kategori') aria-invalid="true" aria-describedby="kategori-error" @enderror
        >
        @error('kategori')
            <span class="field-error" id="kategori-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-field">
        <label for="lokasi">Lokasi rak <span class="required-mark">*</span></label>
        <input
            id="lokasi"
            name="lokasi"
            type="text"
            value="{{ old('lokasi', $buku['lokasi'] ?? '') }}"
            placeholder="Contoh: Rak A-03"
            maxlength="40"
            required
            @error('lokasi') aria-invalid="true" aria-describedby="lokasi-error" @enderror
        >
        @error('lokasi')
            <span class="field-error" id="lokasi-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-field">
        <label for="jumlah">Jumlah eksemplar <span class="required-mark">*</span></label>
        <input
            id="jumlah"
            name="jumlah"
            type="number"
            value="{{ old('jumlah', $buku['jumlah'] ?? 1) }}"
            min="0"
            max="9999"
            required
            @error('jumlah') aria-invalid="true" aria-describedby="jumlah-error" @enderror
        >
        @error('jumlah')
            <span class="field-error" id="jumlah-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-field form-field-wide">
        <label for="kondisi">Kondisi buku <span class="required-mark">*</span></label>
        <select
            id="kondisi"
            name="kondisi"
            required
            @error('kondisi') aria-invalid="true" aria-describedby="kondisi-error" @enderror
        >
            <option value="" disabled @selected(old('kondisi', $buku['kondisi'] ?? '') === '')>Pilih kondisi</option>
            @foreach ($pilihanKondisi as $kondisi)
                <option value="{{ $kondisi }}" @selected(old('kondisi', $buku['kondisi'] ?? '') === $kondisi)>
                    {{ $kondisi }}
                </option>
            @endforeach
        </select>
        @error('kondisi')
            <span class="field-error" id="kondisi-error">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-actions">
    <a class="button button-quiet" href="{{ route('buku.index') }}">Batal</a>
    <button class="button button-primary" type="submit">{{ $labelTombol }}</button>
</div>

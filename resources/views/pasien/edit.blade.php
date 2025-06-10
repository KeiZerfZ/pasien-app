@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Pasien: {{ $pasien->nama }}</h1>

    <!-- Tampilkan error validasi jika ada -->
    @if ($errors->any())
        <div class="alert alert-error mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Penting untuk update -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="nama" class="form-label">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" class="form-input @error('nama') border-red-500 @enderror" value="{{ old('nama', $pasien->nama) }}" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="nik" class="form-label">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" id="nik" class="form-input @error('nik') border-red-500 @enderror" value="{{ old('nik', $pasien->nik) }}" required>
                @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-input @error('tempat_lahir') border-red-500 @enderror" value="{{ old('tempat_lahir', $pasien->tempat_lahir) }}">
                @error('tempat_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-red-500">*</span></label>
                <!-- Tanggal Lahir Disabled dan Greyed Out -->
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input @error('tanggal_lahir') border-red-500 @enderror" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir->format('Y-m-d')) }}" required>
                @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="pekerjaan_id" class="form-label">Pekerjaan <span class="text-red-500">*</span></label>
                <select name="pekerjaan_id" id="pekerjaan_id" class="form-select @error('pekerjaan_id') border-red-500 @enderror" required>
                    <option value="">Pilih Pekerjaan</option>
                    @foreach($pekerjaans as $pekerjaan)
                        <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id', $pasien->pekerjaan_id) == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->nama_pekerjaan }}</option>
                    @endforeach
                </select>
                @error('pekerjaan_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Jenis Kelamin <span class="text-red-500">*</span></label>
                <div class="flex items-center space-x-4 h-full pt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-radio text-indigo-600" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }} required>
                        <span class="ml-2 text-gray-700">Laki-laki</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-indigo-600" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Perempuan</span>
                    </label>
                </div>
                @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 mt-6">Alamat Tinggal <span class="text-red-500">*</span></h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div>
                <label for="provinsi_id" class="form-label">Provinsi</label>
                <select name="provinsi_id" id="provinsi_id" class="form-select @error('provinsi_id') border-red-500 @enderror" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}" {{ old('provinsi_id', $pasien->desa->kecamatan->kota->provinsi_id) == $provinsi->id ? 'selected' : '' }}>{{ $provinsi->nama_provinsi }}</option>
                    @endforeach
                </select>
                @error('provinsi_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="kota_id" class="form-label">Kota/Kabupaten</label>
                <select name="kota_id" id="kota_id" class="form-select @error('kota_id') border-red-500 @enderror" required>
                    <option value="">Pilih Kota/Kabupaten</option>
                    <!-- Options will be loaded by JavaScript -->
                </select>
                @error('kota_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="kecamatan_id" class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" class="form-select @error('kecamatan_id') border-red-500 @enderror" required>
                    <option value="">Pilih Kecamatan</option>
                    <!-- Options will be loaded by JavaScript -->
                </select>
                @error('kecamatan_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="desa_id" class="form-label">Desa/Kelurahan</label>
                <select name="desa_id" id="desa_id" class="form-select @error('desa_id') border-red-500 @enderror" required>
                    <option value="">Pilih Desa/Kelurahan</option>
                    <!-- Options will be loaded by JavaScript -->
                </select>
                @error('desa_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 mt-6">Riwayat Penyakit</h3>
        <div id="riwayat-penyakit-container" class="space-y-4 mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
            @php
                $riwayatPenyakitData = [];
                // Prioritaskan old input jika ada (misal setelah validasi gagal)
                if (old('riwayat_penyakit_nama') !== null) {
                    foreach (old('riwayat_penyakit_nama') as $idx => $nama) {
                        $riwayatPenyakitData[] = [
                            'nama_penyakit' => $nama,
                            'tahun' => old('riwayat_penyakit_tahun.' . $idx),
                        ];
                    }
                } elseif ($pasien->riwayatPenyakits->isNotEmpty()) {
                    // Jika tidak ada old input, gunakan data riwayat penyakit yang sudah ada di pasien
                    foreach ($pasien->riwayatPenyakits as $riwayat) {
                        $riwayatPenyakitData[] = [
                            'nama_penyakit' => $riwayat->nama_penyakit,
                            'tahun' => $riwayat->tahun,
                        ];
                    }
                } else {
                    // Jika tidak ada old input dan tidak ada data riwayat penyakit yang tersimpan, sediakan satu baris kosong
                    $riwayatPenyakitData[] = ['nama_penyakit' => '', 'tahun' => ''];
                }
            @endphp

            @foreach($riwayatPenyakitData as $index => $riwayatItem)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 riwayat-penyakit-item">
                    <div class="col-span-2">
                        <label for="riwayat_penyakit_nama_{{ $index }}" class="sr-only">Nama Penyakit</label>
                        <input type="text" name="riwayat_penyakit_nama[]" id="riwayat_penyakit_nama_{{ $index }}" class="form-input" placeholder="Nama Penyakit" value="{{ $riwayatItem['nama_penyakit'] ?? '' }}">
                    </div>
                    <div>
                        <label for="riwayat_penyakit_tahun_{{ $index }}" class="sr-only">Tahun</label>
                        <div class="flex items-center space-x-2">
                            <input type="number" name="riwayat_penyakit_tahun[]" id="riwayat_penyakit_tahun_{{ $index }}" class="form-input" placeholder="Tahun" min="1900" max="{{ date('Y') }}" value="{{ $riwayatItem['tahun'] ?? '' }}">
                            <button type="button" class="remove-riwayat-penyakit btn btn-danger px-3 py-2 text-sm">Hapus</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-riwayat-penyakit" class="btn btn-secondary px-4 py-2 text-sm shadow-md hover:shadow-lg">Tambah Riwayat Penyakit</button>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 mt-6">Asuransi</h3>
        <div id="asuransi-container" class="space-y-4 mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
            @php
                $asuransiData = [];
                // Prioritaskan old input jika ada (misal setelah validasi gagal)
                if (old('asuransi_jenis') !== null) {
                    foreach (old('asuransi_jenis') as $idx => $jenis) {
                        $asuransiData[] = [
                            'jenis_asuransi_id' => $jenis,
                            'nomor_asuransi' => old('asuransi_nomor.' . $idx),
                        ];
                    }
                } elseif ($pasien->pasienAsuransis->isNotEmpty()) {
                    // Jika tidak ada old input, gunakan data asuransi yang sudah ada di pasien
                    foreach ($pasien->pasienAsuransis as $asuransi) {
                        $asuransiData[] = [
                            'jenis_asuransi_id' => $asuransi->jenis_asuransi_id,
                            'nomor_asuransi' => $asuransi->nomor_asuransi,
                        ];
                    }
                } else {
                    // Jika tidak ada old input dan tidak ada data asuransi yang tersimpan, sediakan satu baris kosong
                    $asuransiData[] = ['jenis_asuransi_id' => '', 'nomor_asuransi' => ''];
                }
            @endphp

            @foreach($asuransiData as $index => $asuransiItem)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 asuransi-item">
                    <div>
                        <label for="asuransi_jenis_{{ $index }}" class="sr-only">Jenis Asuransi</label>
                        <select name="asuransi_jenis[]" id="asuransi_jenis_{{ $index }}" class="form-select">
                            <option value="">Pilih Jenis Asuransi</option>
                            @foreach($jenisAsuransis as $ja)
                                <option value="{{ $ja->id }}" {{ ($asuransiItem['jenis_asuransi_id'] ?? '') == $ja->id ? 'selected' : '' }}>{{ $ja->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="asuransi_nomor_{{ $index }}" class="sr-only">Nomor Asuransi</label>
                        <input type="text" name="asuransi_nomor[]" id="asuransi_nomor_{{ $index }}" class="form-input" placeholder="Nomor Asuransi" value="{{ $asuransiItem['nomor_asuransi'] ?? '' }}">
                    </div>
                    <div class="flex items-center">
                        <button type="button" class="remove-asuransi btn btn-danger px-3 py-2 text-sm">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-asuransi" class="btn btn-secondary px-4 py-2 text-sm shadow-md hover:shadow-lg">Tambah Asuransi</button>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 mt-6">Foto Pasien</h3>
        <div class="mb-6">
            @if($pasien->foto_pasien)
                <div class="mb-4">
                    <label class="form-label">Foto Saat Ini:</label>
                    <img src="{{ Storage::url('pasien_photos/' . $pasien->foto_pasien) }}" alt="Foto Pasien" class="w-32 h-32 object-cover rounded-lg shadow-md">
                    <label class="inline-flex items-center mt-2">
                        <input type="checkbox" name="remove_photo" value="1" class="form-checkbox text-red-600">
                        <span class="ml-2 text-gray-700">Hapus Foto Ini</span>
                    </label>
                </div>
            @endif
            <label for="foto_pasien" class="form-label">Upload Foto Baru (JPG/PNG, maks 2MB)</label>
            <input type="file" name="foto_pasien" id="foto_pasien" class="form-input-file @error('foto_pasien') border-red-500 @enderror">
            @error('foto_pasien') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 mt-8">
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary shadow-md hover:shadow-lg">Batal</a>
            <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">Perbarui Pasien</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinsiSelect = document.getElementById('provinsi_id');
        const kotaSelect = document.getElementById('kota_id');
        const kecamatanSelect = document.getElementById('kecamatan_id');
        const desaSelect = document.getElementById('desa_id');

        // Fungsi untuk mengambil data dinamis
        async function fetchData(url, selectElement, selectedValue = null) {
            selectElement.innerHTML = `<option value="">Memuat...</option>`;
            selectElement.disabled = true;
            try {
                const response = await fetch(url);
                const data = await response.json();
                selectElement.innerHTML = `<option value="">Pilih</option>`;
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.nama_kota || item.nama_kecamatan || item.nama_desa;
                    if (selectedValue && selectedValue == item.id) {
                        option.selected = true;
                    }
                    selectElement.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching data:', error);
                selectElement.innerHTML = `<option value="">Gagal memuat</option>`;
            } finally {
                selectElement.disabled = false;
            }
        }

        // Event listener untuk Provinsi
        provinsiSelect.addEventListener('change', function() {
            const provinsiId = this.value;
            kotaSelect.innerHTML = `<option value="">Pilih Kota/Kabupaten</option>`;
            kecamatanSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;
            desaSelect.innerHTML = `<option value="">Pilih Desa/Kelurahan</option>`;
            kotaSelect.disabled = true;
            kecamatanSelect.disabled = true;
            desaSelect.disabled = true;

            if (provinsiId) {
                fetchData(`/get-kotas-by-provinsi/${provinsiId}`, kotaSelect);
            }
        });

        // Event listener untuk Kota/Kabupaten
        kotaSelect.addEventListener('change', function() {
            const kotaId = this.value;
            kecamatanSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;
            desaSelect.innerHTML = `<option value="">Pilih Desa/Kelurahan</option>`;
            kecamatanSelect.disabled = true;
            desaSelect.disabled = true;

            if (kotaId) {
                fetchData(`/get-kecamatans-by-kota/${kotaId}`, kecamatanSelect);
            }
        });

        // Event listener untuk Kecamatan
        kecamatanSelect.addEventListener('change', function() {
            const kecamatanId = this.value;
            desaSelect.innerHTML = `<option value="">Pilih Desa/Kelurahan</option>`;
            desaSelect.disabled = true;

            if (kecamatanId) {
                fetchData(`/get-desas-by-kecamatan/${kecamatanId}`, desaSelect);
            }
        });

        // Logic untuk mengisi dropdown saat halaman dimuat (untuk data pasien yang ada)
        const initialProvinsiId = "{{ old('provinsi_id', $pasien->desa->kecamatan->kota->provinsi_id ?? '') }}";
        const initialKotaId = "{{ old('kota_id', $pasien->desa->kecamatan->kota_id ?? '') }}";
        const initialKecamatanId = "{{ old('kecamatan_id', $pasien->desa->kecamatan_id ?? '') }}";
        const initialDesaId = "{{ old('desa_id', $pasien->desa_id ?? '') }}";

        if (initialProvinsiId) {
            fetchData(`/get-kotas-by-provinsi/${initialProvinsiId}`, kotaSelect, initialKotaId)
                .then(() => {
                    if (initialKotaId) {
                        fetchData(`/get-kecamatans-by-kota/${initialKotaId}`, kecamatanSelect, initialKecamatanId)
                            .then(() => {
                                if (initialKecamatanId) {
                                    fetchData(`/get-desas-by-kecamatan/${initialKecamatanId}`, desaSelect, initialDesaId);
                                }
                            });
                    }
                });
        }


        // Logic untuk Menambah/Menghapus Riwayat Penyakit
        const riwayatPenyakitContainer = document.getElementById('riwayat-penyakit-container');
        let riwayatPenyakitIndex = riwayatPenyakitContainer.children.length; // Start index from current count

        document.getElementById('add-riwayat-penyakit').addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.classList.add('grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-4', 'riwayat-penyakit-item');
            newItem.innerHTML = `
                <div class="col-span-2">
                    <label for="riwayat_penyakit_nama_${riwayatPenyakitIndex}" class="sr-only">Nama Penyakit</label>
                    <input type="text" name="riwayat_penyakit_nama[]" id="riwayat_penyakit_nama_${riwayatPenyakitIndex}" class="form-input" placeholder="Nama Penyakit">
                </div>
                <div>
                    <label for="riwayat_penyakit_tahun_${riwayatPenyakitIndex}" class="sr-only">Tahun</label>
                    <div class="flex items-center space-x-2">
                        <input type="number" name="riwayat_penyakit_tahun[]" id="riwayat_penyakit_tahun_${riwayatPenyakitIndex}" class="form-input" placeholder="Tahun" min="1900" max="{{ date('Y') }}">
                        <button type="button" class="remove-riwayat-penyakit btn btn-danger px-3 py-2 text-sm">Hapus</button>
                    </div>
                </div>
            `;
            riwayatPenyakitContainer.appendChild(newItem);
            riwayatPenyakitIndex++; // Increment for next added item
        });

        riwayatPenyakitContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-riwayat-penyakit')) {
                e.target.closest('.riwayat-penyakit-item').remove();
            }
        });


        // Logic untuk Menambah/Menghapus Asuransi
        const asuransiContainer = document.getElementById('asuransi-container');
        let asuransiIndex = asuransiContainer.children.length; // Start index from current count

        document.getElementById('add-asuransi').addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.classList.add('grid', 'grid-cols-1', 'md:grid-cols-3', 'gap-4', 'asuransi-item');
            newItem.innerHTML = `
                <div>
                    <label for="asuransi_jenis_${asuransiIndex}" class="sr-only">Jenis Asuransi</label>
                    <select name="asuransi_jenis[]" id="asuransi_jenis_${asuransiIndex}" class="form-select">
                        <option value="">Pilih Jenis Asuransi</option>
                        @foreach($jenisAsuransis as $ja)
                            <option value="{{ $ja->id }}">{{ $ja->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="asuransi_nomor_${asuransiIndex}" class="sr-only">Nomor Asuransi</label>
                    <input type="text" name="asuransi_nomor[]" id="asuransi_nomor_${asuransiIndex}" class="form-input" placeholder="Nomor Asuransi">
                </div>
                <div class="flex items-center">
                    <button type="button" class="remove-asuransi btn btn-danger px-3 py-2 text-sm">Hapus</button>
                </div>
            `;
            asuransiContainer.appendChild(newItem);
            asuransiIndex++; // Increment for next added item
        });

        asuransiContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-asuransi')) {
                e.target.closest('.asuransi-item').remove();
            }
        });
    });
</script>
@endsection

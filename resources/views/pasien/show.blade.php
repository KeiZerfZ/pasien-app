@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Pasien: {{ $pasien->nama }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-primary shadow-md hover:shadow-lg">Edit Pasien</a>
            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger shadow-md hover:shadow-lg">Hapus Pasien</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="md:col-span-1">
            @if($pasien->foto_pasien)
                <img src="{{ Storage::url('pasien_photos/' . $pasien->foto_pasien) }}" alt="Foto Pasien {{ $pasien->nama }}" class="w-full h-auto object-cover rounded-lg shadow-md mb-4">
            @else
                <div class="w-full h-auto bg-gray-200 flex items-center justify-center rounded-lg shadow-md py-10">
                    <span class="text-gray-500">Tidak ada foto</span>
                </div>
            @endif
        </div>
        <div class="md:col-span-2 space-y-4">
            <div>
                <p class="text-sm font-semibold text-gray-600">Nama:</p>
                <p class="text-lg text-gray-900">{{ $pasien->nama }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">NIK:</p>
                <p class="text-lg text-gray-900">{{ $pasien->nik }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tempat, Tanggal Lahir:</p>
                <p class="text-lg text-gray-900">{{ $pasien->tempat_lahir ?? '-' }}, {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Pekerjaan:</p>
                <p class="text-lg text-gray-900">{{ $pasien->pekerjaan->nama_pekerjaan }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Jenis Kelamin:</p>
                <p class="text-lg text-gray-900">{{ $pasien->jenis_kelamin }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Alamat:</p>
                <p class="text-lg text-gray-900">
                    {{ $pasien->desa->nama_desa }}, {{ $pasien->desa->kecamatan->nama_kecamatan }}<br>
                    {{ $pasien->desa->kecamatan->kota->nama_kota }}, {{ $pasien->desa->kecamatan->kota->provinsi->nama_provinsi }}
                </p>
            </div>
        </div>
    </div>

    <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Riwayat Penyakit</h2>
        @if($pasien->riwayatPenyakits->isEmpty())
            <p class="text-gray-600">Tidak ada riwayat penyakit.</p>
        @else
            <ul class="list-disc pl-5 space-y-2">
                @foreach($pasien->riwayatPenyakits as $rp)
                    <li class="text-gray-800">{{ $rp->nama_penyakit }} (Tahun: {{ $rp->tahun }})</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Asuransi</h2>
        @if($pasien->pasienAsuransis->isEmpty())
            <p class="text-gray-600">Tidak ada data asuransi.</p>
        @else
            <ul class="list-disc pl-5 space-y-2">
                @foreach($pasien->pasienAsuransis as $pa)
                    <li class="text-gray-800">
                        {{ $pa->jenisAsuransi->nama_jenis }}: {{ $pa->nomor_asuransi }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="flex justify-start mt-8">
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary shadow-md hover:shadow-lg">Kembali ke Daftar Pasien</a>
    </div>
</div>
@endsection


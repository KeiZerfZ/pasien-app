@extends('layouts.app') <!-- Menggunakan layout dasar -->

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Pasien</h1>
        <a href="{{ route('pasien.create') }}" class="btn btn-primary shadow-md hover:shadow-lg">Tambah Pasien Baru</a>
    </div>

    @if($pasien->isEmpty())
        <div class="text-center text-gray-600 p-8 border border-dashed rounded-lg bg-gray-50">
            <p class="text-xl font-semibold mb-2">Belum ada data pasien.</p>
            <p>Silakan tambahkan pasien baru untuk memulai.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">NIK</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Tgl. Lahir</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Pekerjaan</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Alamat</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="py-3 px-6 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pasien as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 text-sm text-gray-800">{{ $p->nama }}</td>
                            <td class="py-4 px-6 text-sm text-gray-800">{{ $p->nik }}</td>
                            <td class="py-4 px-6 text-sm text-gray-800">{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}</td>
                            <td class="py-4 px-6 text-sm text-gray-800">{{ $p->pekerjaan->nama_pekerjaan }}</td>
                            <td class="py-4 px-6 text-sm text-gray-800">
                                {{ $p->desa->nama_desa }}, {{ $p->desa->kecamatan->nama_kecamatan }}
                                {{ $p->desa->kecamatan->kota->nama_kota }}, {{ $p->desa->kecamatan->kota->provinsi->nama_provinsi }}
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-800">{{ $p->jenis_kelamin }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('pasien.show', $p->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium transition duration-150">Detail</a>
                                    <a href="{{ route('pasien.edit', $p->id) }}" class="text-green-600 hover:text-green-900 text-sm font-medium transition duration-150">Edit</a>
                                    <form action="{{ route('pasien.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium transition duration-150">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection


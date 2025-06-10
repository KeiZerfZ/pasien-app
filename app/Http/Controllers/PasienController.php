<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pekerjaan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\JenisAsuransi;
use App\Models\RiwayatPenyakit;
use App\Models\PasienAsuransi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    /**
     * Menampilkan daftar semua pasien.
     */
    public function index()
    {
        $pasien = Pasien::with(['pekerjaan', 'desa.kecamatan.kota.provinsi'])->get();
        return view('pasien.index', compact('pasien'));
    }

    /**
     * Menampilkan form untuk membuat pasien baru.
     */
    public function create()
    {
        $pekerjaans = Pekerjaan::all();
        $provinsis = Provinsi::all();
        $jenisAsuransis = JenisAsuransi::all();

        return view('pasien.create', compact('pekerjaans', 'provinsis', 'jenisAsuransis'));
    }

    /**
     * Menyimpan pasien baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:pasien,nik|max:20',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'desa_id' => 'required|exists:desas,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'foto_pasien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'riwayat_penyakit_nama.*' => 'nullable|string|max:255',
            'riwayat_penyakit_tahun.*' => 'nullable|integer|min:1900|max:' . date('Y'),
            'asuransi_jenis.*' => 'nullable|exists:jenis_asuransis,id',
            'asuransi_nomor.*' => 'nullable|string|max:255|unique:pasien_asuransis,nomor_asuransi',
        ],
        [
            'nik.unique' => 'NIK ini sudah terdaftar. Mohon gunakan NIK lain.',
            'asuransi_nomor.*.unique' => 'Nomor asuransi :input sudah terdaftar. Mohon gunakan nomor yang berbeda atau periksa kembali.',
            'pekerjaan_id.required' => 'Bidang Pekerjaan wajib diisi.',
            'desa_id.required' => 'Bidang Desa/Kelurahan wajib diisi.',
        ]);

        DB::beginTransaction();
        try {
            $fotoPasienPath = null;
            if ($request->hasFile('foto_pasien')) {
                // UBAH BARIS INI: Tambahkan 'public' sebagai argumen kedua
                $fotoPasienPath = $request->file('foto_pasien')->store('pasien_photos', 'public');
                $fotoPasienPath = basename($fotoPasienPath);
            }

            $pasien = Pasien::create([
                'nama' => $validatedData['nama'],
                'nik' => $validatedData['nik'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'pekerjaan_id' => $validatedData['pekerjaan_id'],
                'desa_id' => $validatedData['desa_id'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'foto_pasien' => $fotoPasienPath,
            ]);

            if ($request->has('riwayat_penyakit_nama')) {
                foreach ($request->riwayat_penyakit_nama as $key => $namaPenyakit) {
                    if (!empty($namaPenyakit) && !empty($request->riwayat_penyakit_tahun[$key])) {
                        $pasien->riwayatPenyakits()->create([
                            'nama_penyakit' => $namaPenyakit,
                            'tahun' => $request->riwayat_penyakit_tahun[$key],
                        ]);
                    }
                }
            }

            if ($request->has('asuransi_jenis')) {
                foreach ($request->asuransi_jenis as $key => $jenisAsuransiId) {
                    if (!empty($jenisAsuransiId) && !empty($request->asuransi_nomor[$key])) {
                        $pasien->pasienAsuransis()->create([
                            'jenis_asuransi_id' => $jenisAsuransiId,
                            'nomor_asuransi' => $request->asuransi_nomor[$key],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Baris ini tidak perlu dikomentari lagi jika kita yakin foto akan tersimpan di lokasi yang benar
            // if ($fotoPasienPath && Storage::disk('public')->exists('pasien_photos/' . $fotoPasienPath)) {
            //     Storage::disk('public')->delete('pasien_photos/' . $fotoPasienPath);
            // }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan detail pasien tertentu.
     */
    public function show(Pasien $pasien)
    {
        $pasien->load(['pekerjaan', 'desa.kecamatan.kota.provinsi', 'riwayatPenyakits', 'pasienAsuransis.jenisAsuransi']);
        return view('pasien.show', compact('pasien'));
    }

    /**
     * Menampilkan form untuk mengedit pasien.
     */
    public function edit(Pasien $pasien)
    {
        $pekerjaans = Pekerjaan::all();
        $provinsis = Provinsi::all();
        $jenisAsuransis = JenisAsuransi::all();
        $pasien->load('desa.kecamatan.kota.provinsi');

        return view('pasien.edit', compact('pasien', 'pekerjaans', 'provinsis', 'jenisAsuransis'));
    }

    /**
     * Memperbarui data pasien di database.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:pasien,nik,' . $pasien->id,
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'desa_id' => 'required|exists:desas,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'foto_pasien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'riwayat_penyakit_nama.*' => 'nullable|string|max:255',
            'riwayat_penyakit_tahun.*' => 'nullable|integer|min:1900|max:' . date('Y'),
            'asuransi_jenis.*' => 'nullable|exists:jenis_asuransis,id',
            'asuransi_nomor.*' => 'nullable|string|max:255',
        ],
        [
            'nik.unique' => 'NIK ini sudah terdaftar. Mohon gunakan NIK lain.',
            'pekerjaan_id.required' => 'Bidang Pekerjaan wajib diisi.',
            'desa_id.required' => 'Bidang Desa/Kelurahan wajib diisi.',
        ]);

        DB::beginTransaction();
        try {
            $fotoPasienPath = $pasien->foto_pasien;
            if ($request->hasFile('foto_pasien')) {
                if ($pasien->foto_pasien && Storage::disk('public')->exists('pasien_photos/' . $pasien->foto_pasien)) {
                    Storage::disk('public')->delete('pasien_photos/' . $pasien->foto_pasien);
                }
                // UBAH BARIS INI: Tambahkan 'public' sebagai argumen kedua
                $fotoPasienPath = $request->file('foto_pasien')->store('pasien_photos', 'public');
                $fotoPasienPath = basename($fotoPasienPath);
            } elseif ($request->input('remove_photo')) {
                if ($pasien->foto_pasien && Storage::disk('public')->exists('pasien_photos/' . $pasien->foto_pasien)) {
                    Storage::disk('public')->delete('pasien_photos/' . $pasien->foto_pasien);
                }
                $fotoPasienPath = null;
            }

            $pasien->update([
                'nama' => $validatedData['nama'],
                'nik' => $validatedData['nik'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'pekerjaan_id' => $validatedData['pekerjaan_id'],
                'desa_id' => $validatedData['desa_id'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'foto_pasien' => $fotoPasienPath,
            ]);

            $pasien->riwayatPenyakits()->delete();
            if ($request->has('riwayat_penyakit_nama')) {
                foreach ($request->riwayat_penyakit_nama as $key => $namaPenyakit) {
                    if (!empty($namaPenyakit) && !empty($request->riwayat_penyakit_tahun[$key])) {
                        $pasien->riwayatPenyakits()->create([
                            'nama_penyakit' => $namaPenyakit,
                            'tahun' => $request->riwayat_penyakit_tahun[$key],
                        ]);
                    }
                }
            }

            if ($request->has('asuransi_nomor')) {
                $uniqueAsuransiNomors = [];
                foreach ($request->asuransi_nomor as $key => $nomorAsuransi) {
                    if (!empty($nomorAsuransi)) {
                        $existingAsuransi = PasienAsuransi::where('nomor_asuransi', $nomorAsuransi)
                                                    ->where('pasien_id', '!=', $pasien->id)
                                                    ->first();
                        if ($existingAsuransi) {
                            DB::rollBack();
                            return redirect()->back()->with('error', "Nomor asuransi '{$nomorAsuransi}' sudah terdaftar untuk pasien lain. Mohon gunakan nomor yang berbeda.")->withInput();
                        }
                        if (in_array($nomorAsuransi, $uniqueAsuransiNomors)) {
                            DB::rollBack();
                            return redirect()->back()->with('error', "Nomor asuransi '{$nomorAsuransi}' terduplikasi dalam input Anda. Mohon periksa kembali.")->withInput();
                        }
                        $uniqueAsuransiNomors[] = $nomorAsuransi;
                    }
                }
            }

            $pasien->pasienAsuransis()->delete();
            if ($request->has('asuransi_jenis')) {
                foreach ($request->asuransi_jenis as $key => $jenisAsuransiId) {
                    if (!empty($jenisAsuransiId) && !empty($request->asuransi_nomor[$key])) {
                        $pasien->pasienAsuransis()->create([
                            'jenis_asuransi_id' => $jenisAsuransiId,
                            'nomor_asuransi' => $request->asuransi_nomor[$key],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Baris ini tidak perlu dikomentari lagi jika kita yakin foto akan tersimpan di lokasi yang benar
            // if ($fotoPasienPath && Storage::disk('public')->exists('pasien_photos/' . $fotoPasienPath)) {
            //     Storage::disk('public')->delete('pasien_photos/' . $fotoPasienPath);
            // }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menghapus pasien dari database.
     */
    public function destroy(Pasien $pasien)
    {
        DB::beginTransaction();
        try {
            if ($pasien->foto_pasien && Storage::disk('public')->exists('pasien_photos/' . $pasien->foto_pasien)) {
                Storage::disk('public')->delete('pasien_photos/' . $pasien->foto_pasien);
            }

            $pasien->delete();

            DB::commit();
            return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * API endpoint untuk mendapatkan kota berdasarkan provinsi_id.
     */
    public function getKotasByProvinsi($provinsi_id)
    {
        $kotas = Kota::where('provinsi_id', $provinsi_id)->get();
        return response()->json($kotas);
    }

    /**
     * API endpoint untuk mendapatkan kecamatan berdasarkan kota_id.
     */
    public function getKecamatansByKota($kota_id)
    {
        $kecamatans = Kecamatan::where('kota_id', $kota_id)->get();
        return response()->json($kecamatans);
    }

    /**
     * API endpoint untuk mendapatkan desa berdasarkan kecamatan_id.
     */
    public function getDesasByKecamatan($kecamatan_id)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json($desas);
    }
}


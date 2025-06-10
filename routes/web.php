<?php

use Illuminate\Support\Facades\Route;
// Import PasienController agar bisa digunakan di routes
use App\Http\Controllers\PasienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route default Laravel, bisa dihapus atau biarkan saja
Route::get('/', function () {
    return redirect()->route('pasien.index');
});

// Route sumber daya (resource) untuk PasienController.
// Ini akan secara otomatis membuat 7 route CRUD standar:
// GET /pasien         -> PasienController@index   (menampilkan daftar)
// GET /pasien/create  -> PasienController@create  (menampilkan form tambah)
// POST /pasien        -> PasienController@store   (menyimpan data baru)
// GET /pasien/{pasien} -> PasienController@show    (menampilkan detail)
// GET /pasien/{pasien}/edit -> PasienController@edit    (menampilkan form edit)
// PUT/PATCH /pasien/{pasien} -> PasienController@update  (memperbarui data)
// DELETE /pasien/{pasien} -> PasienController@destroy (menghapus data)
Route::resource('pasien', PasienController::class);

// Routes untuk AJAX dropdown bertingkat (provinsi -> kota -> kecamatan -> desa)
// Ini adalah API endpoint yang akan dipanggil oleh JavaScript di frontend.
Route::get('get-kotas-by-provinsi/{provinsi_id}', [PasienController::class, 'getKotasByProvinsi']);
Route::get('get-kecamatans-by-kota/{kota_id}', [PasienController::class, 'getKecamatansByKota']);
Route::get('get-desas-by-kecamatan/{kecamatan_id}', [PasienController::class, 'getDesasByKecamatan']);


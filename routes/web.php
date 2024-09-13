<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\BerasController;
use App\Http\Controllers\UangController;
use App\Http\Controllers\MaalController;
use App\Http\Controllers\FidyahController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\PDFController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::middleware('user-access:panitia')->group(function () {
        Route::get('/panitia/home', [MuzakkiController::class, 'home'])->name('panitia.home');

        // Muzakki
        Route::get('/muzakki', [MuzakkiController::class, 'index'])->name('muzakki');
        Route::get('/muzakki/create', [MuzakkiController::class, 'create'])->name('muzakki.create');
        Route::post('/muzakki/store', [MuzakkiController::class, 'store'])->name('muzakki.store');
        Route::delete('/muzakki/{muzakki}', [MuzakkiController::class, 'destroy'])->name('muzakki.destroy');
        Route::get('/muzakki/{muzakki}', [MuzakkiController::class, 'edit'])->name('muzakki.edit');
	    Route::put('/{muzakki}/update', [MuzakkiController::class, 'update'])->name('muzakki.update');
        Route::get('/muzakki-search', [MuzakkiController::class, 'searchMuzakki'])->name('muzakki.search');

        // Zakat Beras
        Route::get('/zakat-beras', [BerasController::class, 'index'])->name('beras.index');
        Route::get('/zakat-beras/create', [BerasController::class, 'create'])->name('beras.create');
        Route::post('/zakat-beras/store', [BerasController::class, 'store'])->name('beras.store');
        Route::delete('/zakat-beras/{id}', [BerasController::class, 'destroy'])->name('beras.destroy');
        Route::get('/zakat-beras/{zakatBeras}', [BerasController::class, 'edit'])->name('beras.edit');
        Route::put('/zakat-beras/{zakatBeras}', [BerasController::class, 'update'])->name('beras.update');
        Route::get('/zakatberas-show/{id}', [BerasController::class, 'show'])->name('beras.show');
        Route::get('/zakatberas-search', [BerasController::class, 'searchBeras'])->name('beras.search');
        Route::post('/beras/save-manual-input', [BerasController::class, 'saveManualInput'])->name('beras.saveManualInput');
        // Route::get('/pdf/zakat-beras/{id}', [PDFController::class, 'generatePDF']);

        // Zakat Uang
        Route::get('/zakat-uang', [UangController::class, 'index'])->name('uang.index');
        Route::get('/zakat-uang/create', [UangController::class, 'create'])->name('uang.create');
        Route::post('/zakat-uang/store', [UangController::class, 'store'])->name('uang.store');
        Route::get('/zakat-uang/{zakatUang}', [UangController::class, 'edit'])->name('uang.edit');
        Route::put('/zakat-uang/{zakatUang}', [UangController::class, 'update'])->name('uang.update');
        Route::delete('/zakat-uang/{id}', [UangController::class, 'destroy'])->name('uang.destroy');
        Route::get('/zakatuang-show/{id}', [UangController::class, 'show'])->name('uang.show');
        Route::get('/zakatuang-search', [UangController::class, 'searchUang'])->name('uang.search');

        // Zakat maal
        Route::get('/zakat-maal', [MaalController::class, 'index'])->name('maal.index');
        Route::get('/zakat-maal/create', [MaalController::class, 'create'])->name('maal.create');
        Route::post('/zakat-maal/store', [MaalController::class, 'store'])->name('maal.store');
        Route::get('/zakat-maal/{zakatMaal}', [MaalController::class, 'edit'])->name('maal.edit');
        Route::put('/zakat-maal/{zakatMaal}', [MaalController::class, 'update'])->name('maal.update');
        Route::delete('/zakat-maal/{id}', [MaalController::class, 'destroy'])->name('maal.destroy');
        Route::get('/zakatmaal-show/{id}', [MaalController::class, 'show'])->name('maal.show');
        Route::get('/zakatmaal-search', [MaalController::class, 'searchMaal'])->name('maal.search');

        // Fidyah
        Route::get('/fidyah', [FidyahController::class, 'index'])->name('fidyah.index');
        Route::get('/fidyah/create', [FidyahController::class, 'create'])->name('fidyah.create');
        Route::post('/fidyah/store', [FidyahController::class, 'store'])->name('fidyah.store');
        Route::get('/fidyah/{fidyah}', [FidyahController::class, 'edit'])->name('fidyah.edit');
        Route::put('/fidyah/{fidyah}', [FidyahController::class, 'update'])->name('fidyah.update');
        Route::delete('/fidyah/{id}', [FidyahController::class, 'destroy'])->name('fidyah.destroy');
        Route::get('/fidyah-show/{id}', [FidyahController::class, 'show'])->name('fidyah.show');
        Route::get('/fidyah-search', [FidyahController::class, 'searchFidyah'])->name('fidyah.search');

        // rekap
        Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
        Route::get('/generate-pdf', [RekapController::class, 'generatePDF'])->name('rekap.pdf');
        
        // Route::get('/ahligizi/home', [AhligiziController::class, 'ahligiziHome'])->name('ahligizi.home');
        // Route::get('/screening/create', [ScreeningController::class, 'create'])->name('screening.create');
        // Route::post('/screening/store', [ScreeningController::class, 'store'])->name('storeScreening');
        // // Route::get('/screening/{id}', [AhligiziController::class, 'showSc'])->name('showScreening');
        // // Route::get('/screening/{id}', [AhligiziController::class, 'dataScreening'])->name('ahligizi.screening');
        // // Route::get('/screening', [AhligiziController::class, 'dataScreening'])->name('ahligizi.screening');
        // Route::get('/{id}/edit', [ScreeningController::class, 'edit'])->name('screening.edit');
        // Route::put('/{id}/update', [ScreeningController::class, 'update'])->name('updateScreening');
        // Route::get('/{id}/delete', [ScreeningController::class, 'destroy'])->name('screening.delete');
        
        // Route::get('/ahligizi/tables', [AhliGiziController::class, 'ahligiziTables'])->name('ahligizi.tables');
        // Route::get('/pasien', [AhligiziController::class, 'pasienData'])->name('pasien.index');
        // Route::get('/pasien/{id}', [AhligiziController::class, 'detailPasien'])->name('pasien.detail');
        // Route::get('/ahligizi/search-pasien', [AhligiziController::class, 'searchPasien'])->name('pasien.search');
        // Route::get('/ahligizi/search-screening', [ScreeningController::class, 'searchScreening'])->name('screening.search');
        // Route::get('/pasien/screening/{id}', [AhligiziController::class, 'dataScreening'])->name('pasien.screening');

        // Route::get('/pdf/screening/{id}', [ScreeningController::class, 'generatePDF']);

    });

    Route::middleware('user-access:muzakki')->group(function () {
    });

    Route::get('profile', function () {
		return view('profile');
	})->name('profile');
    Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    // Route::get('/screening/{id}', [ScreeningController::class, 'detailScreening'])->name('screening.detail');
    // Route::get('/screening', [ScreeningController::class, 'screeningData'])->name('screening.index');
    // Route::get('/pdf/screening/{id}', [ScreeningController::class, 'generatePDF']);
    // // Route::get('/screening/{id}', [ScreeningController::class, 'detailScreening'])->name('screening.detail');
});
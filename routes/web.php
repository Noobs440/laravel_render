<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usecases\Authcontroller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('user/verify/{token}', [Authcontroller::class, 'verifyAccount'])->name('user.verify');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Connexion OK avec la base MySQL ✅';
    } catch (\Exception $e) {
        return 'Erreur connexion DB ❌ : ' . $e->getMessage();
    }
});

Route::get('/debug', function () {
    Log::debug('Test de log');
    return 'Log envoyé.';
});


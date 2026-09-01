<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsApiController;

/*
|--------------------------------------------------------------------------
| Portal SMAN 5 Pulau Morotai - Mobile Public API Routes
|--------------------------------------------------------------------------
| Melayani endpoint berita dan pengumuman untuk aplikasi mobile MORO⁵SMART
*/

Route::prefix('berita')->group(function () {
    Route::get('/', [NewsApiController::class, 'index']);
    Route::get('/latest', [NewsApiController::class, 'latest']);
    Route::get('/{slug}', [NewsApiController::class, 'show']);
});

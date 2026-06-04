<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\{HomeController, AnnouncementController as PublicAnnouncementController, MapController, ProfileController as PublicProfileController, ContactController, DocumentController as PublicDocumentController, StudentsController};
use App\Http\Controllers\Admin\{DashboardController, AnnouncementController, StudentMapController, PortalLinkController, DocumentController as AdminDocumentController};


use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pengumuman', [PublicAnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/pengumuman/{encryptedAnnouncement}', [PublicAnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/berita', [\App\Http\Controllers\Public\NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\Public\NewsController::class, 'show'])->name('news.show');
Route::get('/peta-siswa', [MapController::class, 'index'])->name('map.index');
Route::get('/profil', [PublicProfileController::class, 'index'])->name('profile.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Documents (public)
Route::get('/dokumen', [PublicDocumentController::class, 'index'])->name('documents.index');
Route::get('/dokumen/{document}/request', [PublicDocumentController::class, 'request'])->name('documents.request');
Route::post('/dokumen/{document}/download', [PublicDocumentController::class, 'download'])->name('documents.download');



// Public: Students
Route::get('/siswa', [StudentsController::class, 'index'])->name('students.index');

// Alias route untuk redirect saat login (breeze default)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/pengumuman', AnnouncementController::class)
        ->parameters(['pengumuman' => 'announcement'])
        ->names('announcements');

    Route::resource('/portal-links', PortalLinkController::class);
    Route::resource('/peta-siswa', StudentMapController::class)->names('map');
    Route::get('/peta-siswa/data', [StudentMapController::class, 'getData'])->name('map.data');

    // New Routes
    Route::resource('/teachers', \App\Http\Controllers\Admin\TeacherController::class);
    Route::resource('/students', \App\Http\Controllers\Admin\StudentController::class);
    Route::resource('/rooms', \App\Http\Controllers\Admin\RoomController::class);
    Route::resource('/banners', \App\Http\Controllers\Admin\BannerController::class);
    Route::resource('/news', \App\Http\Controllers\Admin\NewsController::class);

    // Documents
    Route::resource('/documents', AdminDocumentController::class)->except(['show']);
    Route::get('/documents/{document}/show', [AdminDocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/downloads', [AdminDocumentController::class, 'downloads'])->name('documents.downloads');

    Route::get('/school-profile', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'index'])->name('school-profile.index');
    Route::post('/school-profile/sambutan', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'updateSambutan'])->name('school-profile.sambutan');
    Route::post('/school-profile/struktur', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'updateStruktur'])->name('school-profile.struktur');
    Route::post('/school-profile/foto', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'updateFotoKepsek'])->name('school-profile.foto');
    Route::post('/school-profile/visi-misi-sejarah', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'updateVisiMisiSejarah'])->name('school-profile.visi-misi-sejarah');
});


require __DIR__ . '/auth.php';

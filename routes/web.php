<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminAttachmentController;
use App\Http\Controllers\AttachmentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RegistrationController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/berita', [NewsController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');
Route::get('/galeri/{gallery}', [GalleryController::class, 'show'])->name('galeri.show');
Route::get('/lampiran', [AttachmentController::class, 'index'])->name('lampiran');
Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('pendaftaran');
Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('pendaftaran.store');
Route::get('/lampiran/download/{attachment}', [AttachmentController::class, 'download'])->name('lampiran.download');
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');
Route::get('/struktur-organisasi', [App\Http\Controllers\StructureController::class, 'index'])->name('struktur');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::resource('admin/news', AdminNewsController::class)->names('admin.news');
    Route::resource('admin/galleries', AdminGalleryController::class)->names('admin.galleries');
    Route::resource('admin/attachments', AdminAttachmentController::class)->names('admin.attachments');
    Route::patch('admin/attachments/{attachment}/toggle-visibility', [AdminAttachmentController::class, 'toggleVisibility'])->name('admin.attachments.toggleVisibility');
    
    // User / Account Routes
    Route::get('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    
    // Organization Structure Routes
    Route::resource('admin/organizations', App\Http\Controllers\AdminOrganizationController::class)->names('admin.organizations');
    Route::resource('admin/organizations.members', App\Http\Controllers\AdminMemberController::class)->names('admin.members')->shallow();

    // Registrations Routes
    Route::post('admin/registrations/toggle-status', [App\Http\Controllers\AdminRegistrationController::class, 'toggleStatus'])->name('admin.registrations.toggleStatus');
    Route::put('admin/registrations/update-wa-link', [App\Http\Controllers\AdminRegistrationController::class, 'updateWaLink'])->name('admin.registrations.updateWaLink');
    Route::delete('admin/registrations/destroy-all', [App\Http\Controllers\AdminRegistrationController::class, 'destroyAll'])->name('admin.registrations.destroyAll');
    Route::get('admin/registrations/export-csv', [App\Http\Controllers\AdminRegistrationController::class, 'exportCsv'])->name('admin.registrations.exportCsv');
    Route::resource('admin/registrations', App\Http\Controllers\AdminRegistrationController::class)->only(['index', 'show', 'destroy'])->names('admin.registrations');

    // Setting Routes
    Route::get('/admin/settings', [App\Http\Controllers\AdminSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/admin/settings', [App\Http\Controllers\AdminSettingController::class, 'update'])->name('admin.settings.update');
});

require __DIR__.'/auth.php';

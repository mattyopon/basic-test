<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
})->name('top');

Route::get('/register', function () {
    return view('register');
})->name('register')->middleware('guest');

// Fortifyが自動的に /register のPOSTルートを登録します

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

// お問い合わせフォーム
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/confirm', [App\Http\Controllers\ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/thanks', [App\Http\Controllers\ContactController::class, 'thanks'])->name('contact.thanks');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/contact/{id}', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.contact.show');
    Route::delete('/admin/contact/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.contact.destroy');
    Route::get('/admin/export', [App\Http\Controllers\AdminController::class, 'export'])->name('admin.export');
    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
});

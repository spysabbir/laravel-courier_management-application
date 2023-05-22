<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('all-branch', [FrontendController::class, 'allBranch'])->name('all.branch');
Route::get('all-service', [FrontendController::class, 'allService'])->name('all.service');
Route::get('about-us', [FrontendController::class, 'aboutUs'])->name('about.us');
Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('terms-of-service', [FrontendController::class, 'termsOfService'])->name('terms.of.service');

Route::get('contact-us', [FrontendController::class, 'contactUs'])->name('contact.us');
Route::post('contact-message-send', [FrontendController::class, 'contactMessageSend'])->name('contact.message.send');

Route::get('check-status', [FrontendController::class, 'checkStatus'])->name('check.status');
Route::post('check-status-result', [FrontendController::class, 'checkStatusResult'])->name('check.status.result');

require __DIR__.'/admin.php';

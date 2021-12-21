<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
Route::post('/setting/setWebhook', [SettingController::class, 'setWebHook'])->name('setting.setWebhook');
Route::post('/setting/getWebhookInfo', [SettingController::class, 'getWebHookInfo'])->name('setting.getWebhookInfo');
Route::post(Telegram::getAccessToken(), function () {
  Telegram::commandsHandler(true);
});


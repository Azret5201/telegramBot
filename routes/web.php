<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Keyboard\Keyboard;
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

//Route::get('/', function (\App\Helpers\Telegram $telegram){
////    $keyboard = Keyboard::make(['resize_keyboard' => true]) ->row( Keyboard::button(['text' => "\xE2\x9C\x8F Register1"]), Keyboard::button(['text' => "\xE2\x98\x91 Verify Account"]) );
////    $telegram->sendButtons(533372516, 'test', json_encode($keyboard));
//    $data = file_get_contents('php://input');
//    $data = json_decode($data, true);
//    dd($data);
//    if (!empty($data['message']['text'])) {
//        $text = $data['message']['text'];
//        echo $text;
//    }
//});
Route::get('/', [DashboardController::class, 'index']);
Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
Route::post('/setting/setWebhook', [SettingController::class, 'setWebHook'])->name('setting.setWebhook');
Route::post('/setting/getWebhookInfo', [SettingController::class, 'getWebHookInfo'])->name('setting.getWebhookInfo');
Route::post(Telegram::getAccessToken(), function () {
  Telegram::commandsHandler(true);
});
Route::get('/bot', [\App\Http\Controllers\TelegramController::class, 'index']);

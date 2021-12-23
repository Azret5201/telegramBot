<?php



namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Api;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

//use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function index()
    {
        $this->setWebHook();
        echo(session()->get('result'));

        dd(Telegram::getWebhookUpdates());

//        $telegram = new Api('5015696246:AAGTsY1qTUo6rfxVXojiCLchJJy-vC74rhA');
//        $result = Telegram::getWebhookUpdates(); //MARK
//        $telegramUser = $telegram->getWebhookUpdates();


//        $telegramUser = Telegram::getWebhookUpdates()['message'];
//        dd($telegramUser);
//        $text = $result['message']['text'];
//        $chat_id = $result['message']['chat']['id'];
//        $name = $result['message']['from']['username'];
//        $first_name = $result['message']['from']['first_name'];
//        $last_name = $result['message']['from']['last_name'];
//
//        if ($text == '/hallo') {
//            $reply = 'HEllo';
//            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
//        }
    }


    public function setWebHook(): void
    {
        $result = $this->sendTelegramData('setWebhook', [
            'query' => ['url' => 'https://c95d-212-112-122-222.ngrok.io' . '/' . Telegram::getAccessToken()]
        ]);
        session()->put('result', $result);
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendTelegramData($route = '', $params = [], $method = 'POST'): string
    {
        $client = new Client(['base_uri' => 'https://api.telegram.org/bot' . Telegram::getAccessToken() . '/']);
        $result = $client->request($method, $route, $params);
        return (string) $result->getBody();
    }
}


//        $telegram = new Api('5015696246:AAGTsY1qTUo6rfxVXojiCLchJJy-vC74rhA');
//        $result = Telegram::getWebhookUpdates(); //MARK
//        $telegramUser = $telegram->getWebhookUpdates();
//
//
//        $telegramUser = Telegram::getWebhookUpdates()['message'];
//        dd($telegramUser);
//        $text = $result['message']['text'];
//        $chat_id = $result['message']['chat']['id'];
//        $name = $result['message']['from']['username'];
//        $first_name = $result['message']['from']['first_name'];
//        $last_name = $result['message']['from']['last_name'];
//
//        if ($text == '/hallo') {
//            $reply = 'HEllo';
//            $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
//        }
//        return view('result');

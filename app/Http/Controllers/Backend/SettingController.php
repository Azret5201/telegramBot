<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Laravel\TelegramServiceProvider;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting', Setting::getSettings());
    }

    public function store(Request $request)
    {
        Setting::where('key', '!=', NULL)->delete();
        foreach ($request->except('_token') as $key => $item) {
                $setting = new Setting();
                $setting->key = $key;
                $setting->value = $request->$key;
                $setting->save();
        }
        return redirect()->route('setting.index');
    }

    public function setWebHook(Request $request): RedirectResponse
    {
        $result = $this->sendTelegramData('setWebhook', [
            'query' => ['url' => $request->url . '/' . Telegram::getAccessToken()]
        ]);
        return redirect()->route('setting.index')->with('status', $result);
    }

    public function getWebHookInfo(Request $request)
    {
        $result = $this->sendTelegramData('getWebhookInfo');
        return redirect()->route('setting.index')->with('status', $result);

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

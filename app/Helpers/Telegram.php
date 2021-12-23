<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Telegram
{
    protected $http;
    const url = 'https://api.telegram.org/bot';

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function sendMessage($chat_id, $message){
        return  Http::post(self::url .\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken().'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html'
        ]);
    }

//    public function replyMessage($chat_id, $message, $message_id){
//        return  $this->http::post(self::url.\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken().'/sendMessage', [
//            'chat_id' => $chat_id,
//            'text' => $message,
//            'parse_mode' => 'html',
//            'reply_to_message_id' => $message_id
//        ]);
//    }
//    public function editMessage($chat_id, $message, $message_id){
//        return  $this->http::post(self::url.\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken().'/editMessageText', [
//            'chat_id' => $chat_id,
//            'text' => $message,
//            'parse_mode' => 'html',
//            'message_id' => $message_id
//        ]);
//    }
    public function sendDocument($chat_id, $file){
        return  $this->http::attach('document', Storage::get('/public/'.$file), 'document.png')
            ->post(self::url.\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken().'/sendDocument', [
                'chat_id' => $chat_id,
            ]);
    }

    public function sendButtons($chat_id, $message, $button): \Illuminate\Http\Client\Response
    {
        return  $this->http::post(self::url.\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken().'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button
        ]);
    }

    public function sendTelegram($method, $data, $headers = [])
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_POST =>1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::url.\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken(). '/' . $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge(array("Content-Type: application/json"), $headers )
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        return (json_decode($result, 1) ? json_decode($result, 1) : $result);
    }

//    public function editButtons($chat_id, $message, $button, $message_id){
//        return  $this->http::post(self::url.\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken().'/editMessageText', [
//            'chat_id' => $chat_id,
//            'text' => $message,
//            'parse_mode' => 'html',
//            'reply_markup' => $button,
//            'message_id' => $message_id,
//        ]);
//    }

 }

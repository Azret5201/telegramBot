<?php

namespace App\Telegram;

use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

//    /**
//     * @var array Command Aliases
//     */
//    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'start command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $telegramUser = Telegram::getWebhookUpdates();
        $text = "Добро пожаловать в бот 'Мол-Түшүм' ! Данный бот создан в рамках проекта 'Содействие в восстановлении сельскохозяйственных производственных цепочек в пост COVID-19 период' .  Бот позволяет обменяться нужной информацией  о с\х продукции(семенной материал,корм,удобрение) и предоставляет возможность быстро и доступно получить нужную информацию по семенным материалам,услугами  и другими Агро продукцией между   общественными семенными фондами(ОСФ) а также их потребителями(фермерами) а  также другими  всеми заинтересованными сторонами.
";
        Storage::put('msg.text', $telegramUser);
        $keyboard = Keyboard::make(['resize_keyboard' => true])
            ->row( Keyboard::button(['text' => "Информация об ОСФ"]))
            ->row(Keyboard::button(['text' => "Услуги/Специалисты"]))
            ->row(Keyboard::button(['text' => "Объявления"]))
            ->row(Keyboard::button(['text' => "Библиотека"]))
            ->row(Keyboard::button(['text' => "База данных"]))
            ->row(Keyboard::button(['text' => "Настройки профиля"]));

        $encodedBtn = json_encode($keyboard);
        $response = Telegram::sendMessage([
            'chat_id' => $telegramUser['message']['from']['id'],
            'text' => $text,
            'parse_mode' => 'HTML',
            'reply_markup' => $encodedBtn
        ]);


    }
}

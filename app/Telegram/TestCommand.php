<?php


namespace App\Telegram;

use Illuminate\Support\Facades\Http;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class TestCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'test';

    protected $telegram;

    public function __construct(\App\Helpers\Telegram  $telegram)
    {
        $this->telegram = $telegram;
    }

//    /**
//     * @var array Command Aliases
//     */
//    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
       $this->replyWithChatAction(['action' => Actions::TYPING]);
       $telegramUser = Telegram::getWebhookUpdates()['message'];
       //Сделать проверку на налиие имени
        $text = sprintf('%s: %s'.PHP_EOL, 'Ваш номер чата', $telegramUser['from']['id']);

        $response = Telegram::sendMessage([
            'chat_id' => $telegramUser['from']['id'],
            'text' => 'Hello World',
            'reply_markup' => json_encode([
                'keyboard '=>[
                    [
                        ['text'=>'Register'],['text'=>'Войти']
                    ],
                ]
            ])
        ]);

        $this->replyWithMessage(compact('text'));

    }
}


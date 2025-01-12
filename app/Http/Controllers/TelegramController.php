<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function getMe()
    {
        $response = Telegram::getMe();
        return $response;
    }

    // method webhook
    public function webhook()
    {
        $response = Telegram::commandsHandler(true);
        return $response;
    }

    // make method getUpdates
    public function getUpdates()
    {
        $response = Telegram::getUpdates();
        return $response;
    }

    // method sendMessage
    public function sendMessage()
    {
        $message = "✅ Informasi\n";
        $message .= "📅 Tanggal\n";
        $message .= "⌛️Password ||spoiler|| \n\n";
        $message .= "*bold \*text*
_italic \*text_
__underline__
~strikethrough~
||spoiler||
*bold _italic bold ~italic bold strikethrough ||italic bold strikethrough spoiler||~ __underline italic bold___ bold*
[inline URL](http://www.example.com/)
[inline mention of a user](tg://user?id=123456789)
![👍](tg://emoji?id=5368324170671202286)
`inline fixed-width code`
```
pre-formatted fixed-width code block
```
```python
pre-formatted fixed-width code block written in the Python programming language
```
>Block quotation started
>Block quotation continued
>Block quotation continued
>Block quotation continued
>The last line of the block quotation
**>The expandable block quotation started right after the previous block quotation
>It is separated from the previous block quotation by an empty bold entity
>Expandable block quotation continued
>Hidden by default part of the expandable block quotation started
>Expandable block quotation continued
>The last line of the expandable block quotation with the expandability mark||";

        $response = Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => $message,
            'parse_mode' => "MarkdownV2",
        ]);
        return $response;
    }

    // make method setWebhook
    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        return $response;
    }

    // make method removeWebhook
    public function removeWebhook()
    {
        $response = Telegram::removeWebhook();
        return $response;
    }
}

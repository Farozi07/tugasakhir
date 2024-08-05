<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');
        $message = $request->message;

        $url = "https://api.telegram.org/bot$token/sendMessage";
        $response = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $message
        ]);

        return $response->json();
    }
}

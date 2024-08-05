<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $token = '6305104397:AAGLTxW4fx6dERILWnbo3NoUkIgXPiE-JE8';
        $chat_id = '1089090463';
        $message = $request->message;

        $url = "https://api.telegram.org/bot$token/sendMessage";
        $response = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $message
        ]);

        return $response->json();
    }
}

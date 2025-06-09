<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function webhook(Request $request)
    {
        $verifyToken = 'EAAVoz2v31k8BO68GwACaJuTd8mZC373wnwRQ6raliIAFgcVvFEJTs9Gij3y2ypz2KFmvzlmwSaoZA4SVuTXlDe48eUOdIWN5JYoopsZA0E2BeeN4OsVKlTVhApMZBDIMt08ReLpHhs3uZBiBWqRtw7Blj3YORKO3TQZBdG7N1aXLFUdKLKPyGfAqIlIhWz1ZClXl1T3KYID6AeZBgAp8lqdZCO3h60s2qX5XDpHUZD'; 

        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');

        if ($mode && $token) {
            if ($mode === 'subscribe' && $token === $verifyToken) {
                return response($challenge, 200);
            } else {
                return response('Token inválido', 403);
            }
        }

        $body = $request->all();

        Log::info('WhatsApp Webhook received:', $body);

        // verificar si es un mensaje entrante
        if (isset($body['entry'][0]['changes'][0]['value']['messages'][0])) {
            $message = $body['entry'][0]['changes'][0]['value']['messages'][0];
            $from = $message['from']; // número de quien envió
            $text = $message['text']['body'] ?? '';

            //enviar notificaciones
            Log::info("Mensaje recibido de $from: $text");

        }

        return response('EVENT_RECEIVED', 200);
    }
}

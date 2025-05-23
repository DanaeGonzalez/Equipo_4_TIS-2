<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as GoogleClient;

class GoogleKeepController extends Controller
{
    public function login()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setScopes(['https://www.googleapis.com/auth/keep']);
        $client->setDeveloperKey(config('services.google.api_key'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return redirect($client->createAuthUrl());
    }

    public function callback(Request $request)
    {
        // 1. Crear cliente Google
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->setScopes(['https://www.googleapis.com/auth/keep']);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        // 2. Obtener código de autorización de la URL
        $code = $request->get('code');

        if (!$code) {
            return redirect()->route('google.keep.login')->with('error', 'No se recibió código de autorización.');
        }

        // 3. Intercambiar código por token de acceso
        $token = $client->fetchAccessTokenWithAuthCode($code);

        // 4. Manejo de errores
        if (isset($token['error'])) {
            return response()->json([
                'error' => $token['error'],
                'message' => $token['error_description'] ?? 'Error desconocido al obtener token'
            ], 400);
        }

        // 5. Guardar token en sesión (o base de datos)
        session(['google_keep_token' => $token]);

        // 6. Configurar cliente con token
        $client->setAccessToken($token);

        // 7. Crear servicio Google Keep para hacer llamadas a la API
        $service = new \Google\Service\Keep($client);

        // 8. Ejemplo: listar notas (puedes modificar según lo que quieras hacer)
        $notes = $service->notes->listNotes();

        // 9. Mostrar resultados o vista
        return view('googlekeep.notes', ['notes' => $notes->getNotes()]);
    }


}

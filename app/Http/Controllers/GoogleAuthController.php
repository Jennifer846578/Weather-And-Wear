<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->addScope(Calendar::CALENDAR_READONLY);
        $client->setRedirectUri(route('google.callback'));

        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setRedirectUri(route('google.callback'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        $client->setAccessToken($token);

        if (isset($token['refresh_token'])) {
            $token['refresh_token'] = $token['refresh_token'];
        }

        Session::put('google_token', $token);

        // return redirect()->route('view.schedule');
        return redirect()->route('home');
    }

    public function getCalendarEvents()
    {
        // if (!Session::has('google_token')) {
        //     return redirect()->route('google.auth');
        // }

        // $client = new Client();
        // $client->setAuthConfig(storage_path('credentials.json'));
        // $client->setAccessToken(Session::get('google_token'));

        // if ($client->isAccessTokenExpired()) {
        //     return redirect()->route('google.auth');
        // }

        // // $service = new Calendar($client);
        // // $events = $service->events->listEvents('primary')->getItems();

        // // Session::put('google_token', $client->getAccessToken());

        // $service = new Calendar($client);

    // Set waktu sekarang dalam format RFC3339 (ISO 8601)
        // $timeMin = date('Y-m-d\T00:00:00\Z'); // Mulai hari ini pukul 00:00
        // $timeMax = date('Y-m-d\T23:59:59\Z'); // Akhir hari ini pukul 23:59

        // $optParams = [
        //     'singleEvents' => true,
        //     'orderBy' => 'startTime',
        //     'timeMin' => $timeMin,
        //     'timeMax' => $timeMax,
        // ];

        // $events = $service->events->listEvents('primary', $optParams)->getItems();

        // // Update token untuk menjaga sesi aktif
        // Session::put('google_token', $client->getAccessToken());

        // return view('homepage', compact('events'));
    }
}
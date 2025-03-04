<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class homepageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->client = new Client();        
		// $this->client->setClientId(config('services.google.client_id'));        
		// $this->client->setClientSecret(config('services.google.client_secret'));        
		// $this->client->setRedirectUri(config('services.google.redirect'));        
		// $this->client->addScope(Calendar::CALENDAR);        
		// $this->calendarService = new Calendar($this->client);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fetchdata = Http::get('https://api.openweathermap.org/data/2.5/weather?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
        // session()->put('fetchdata',$fetchdata['dt']);

        if (!Session::has('google_token')) {
            return redirect()->route('google.auth');
        }

        $client = new Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setAccessToken(Session::get('google_token'));

        if ($client->isAccessTokenExpired()) {
            return redirect()->route('google.auth');
        }

        // $service = new Calendar($client);
        // $events = $service->events->listEvents('primary')->getItems();

        Session::put('google_token', $client->getAccessToken());

        $service = new Calendar($client);
        // $service = $this->calendarService;

        // Set waktu sekarang dalam format RFC3339 (ISO 8601)
        $timeMin = date('Y-m-d\T00:00:00\Z'); // Mulai hari ini pukul 00:00
        $timeMax = date('Y-m-d\T23:59:59\Z'); // Akhir hari ini pukul 23:59

        // $timeMin = date('Y-m-01\T00:00:00\Z'); // Mulai awal bulan ini
        // $timeMax = date('Y-m-t\T23:59:59\Z'); // Sampai akhir bulan ini


        $optParams = [
            'singleEvents' => true,
            'orderBy' => 'startTime',
            'timeMin' => $timeMin,
            'timeMax' => $timeMax,
        ];

        $events = $service->events->listEvents('primary', $optParams)->getItems();

        // Update token untuk menjaga sesi aktif
        Session::put('google_token', $client->getAccessToken());

        // dd($events[0]->summary);
        return view('homepage', compact('fetchdata', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

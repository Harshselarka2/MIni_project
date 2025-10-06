<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    public function index()
    {
        $logs = Weather::latest()->take(10)->get();
        return view('home', compact('logs'));
    }

    public function search(Request $request)
    {
        $city = $request->input('city');
        if (!$city) {
            return redirect('/')->with('error', 'Please enter a city name.');
        }

        $apiKey = env('OPENWEATHER_API_KEY');
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        if ($response->failed()) {
            return redirect('/')->with('error', 'City not found or API error.');
        }

        $data = $response->json();
        $temp = $data['main']['temp'] ?? null;
        $humidity = $data['main']['humidity'] ?? null;
        $lat = $data['coord']['lat'] ?? null;
        $lon = $data['coord']['lon'] ?? null;

        // Flask ML Prediction
        $prediction = 'N/A';
        try {
            $flaskResponse = Http::timeout(3)->post("http://127.0.0.1:5000/predict", [
                'temp' => $temp,
                'humidity' => $humidity
            ]);
            if ($flaskResponse->ok()) {
                $prediction = $flaskResponse->json()['prediction'] ?? 'N/A';
            }
        } catch (\Exception $e) {
            Log::error('Flask unavailable: ' . $e->getMessage());
            $prediction = 'Flask service unavailable';
        }

        // Save to DB
        $weather = Weather::create([
            'city' => ucfirst($city),
            'temperature' => $temp,
            'humidity' => $humidity,
            'latitude' => $lat,
            'longitude' => $lon,
            'prediction' => $prediction,
            'recorded_at' => now(),
        ]);

        // Redirect with success + latestCityId
        return redirect('/')
            ->with('success', "Weather for {$city}: {$temp}°C — Prediction: {$prediction}")
            ->with('latestCityId', $weather->id);
    }
}

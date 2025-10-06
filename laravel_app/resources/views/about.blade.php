@extends('layouts.app')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-4xl font-bold text-blue-600">🌤 About Weather Prediction System</h1>
    <p class="text-gray-700 mt-2">Learn more about this project and how it works.</p>
</div>

<div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6 space-y-6">
    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Project Overview</h2>
        <p class="text-gray-700">
            This Weather Prediction System is a full-stack web application built with 
            <span class="font-bold text-blue-600">Laravel</span> and 
            <span class="font-bold text-green-600">Flask ML Service</span>. 
            It fetches real-time weather data, stores it in a database, and predicts rainfall using a decision tree model.
        </p>
    </section>

    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Features</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>Real-time weather data via OpenWeatherMap API</li>
            <li>Historical weather logging in MySQL</li>
            <li>Rainfall prediction using a Machine Learning model</li>
            <li>Interactive Leaflet map showing searched city</li>
            <li>Temperature charts for last 24 hours per city</li>
            <li>Responsive and modern UI using Tailwind CSS and Bootstrap</li>
        </ul>
    </section>

    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Tech Stack</h2>
        <div class="flex flex-wrap gap-4 text-gray-700">
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">Laravel</span>
            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full">Flask (Python)</span>
            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full">MySQL</span>
            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">Chart.js</span>
            <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full">Leaflet.js</span>
            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full">Bootstrap</span>
            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full">Tailwind CSS</span>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">How it Works</h2>
        <ol class="list-decimal list-inside text-gray-700 space-y-1">
            <li>User enters a city in the search form.</li>
            <li>Laravel controller fetches current weather from OpenWeatherMap API.</li>
            <li>Data is sent to Flask ML service to predict rainfall.</li>
            <li>Weather data is stored in MySQL database.</li>
            <li>Dashboard updates with latest weather, map zoom, and chart for last 24h temperatures.</li>
        </ol>
    </section>

    <section class="text-center mt-6">
        <p class="text-gray-600">© 2025 Weather Prediction System. Built with ❤️ by <span class="font-bold">Harsh Patel</span>.</p>
    </section>
</div>
@endsection

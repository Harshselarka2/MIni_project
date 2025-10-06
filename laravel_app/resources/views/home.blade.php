@extends('layouts.app')

@section('content')
<div class="text-center mb-6">
    <h1 class="text-4xl font-bold text-blue-600">🌤 Weather Dashboard</h1>
    <p class="text-gray-700 mt-2">Search weather, view predictions & logs</p>
</div>

<!-- Search Form -->
<form action="{{ route('search') }}" method="POST" class="row justify-content-center mb-4">
    @csrf
    <div class="col-md-5">
        <input type="text" name="city" class="form-control rounded-l-md" placeholder="Enter city name">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-gradient w-100 rounded-r-md">Search</button>
    </div>
</form>

<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

<!-- Recent Logs -->
<div class="card shadow-lg mb-5">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Recent Weather Logs</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>City</th>
                    <th>Temp (°C)</th>
                    <th>Humidity (%)</th>
                    <th>Prediction</th>
                    <th>Recorded At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $log->city }}</td>
                    <td>{{ $log->temperature }}</td>
                    <td>{{ $log->humidity ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $log->prediction === 'Rain' ? 'bg-info' : 'bg-success' }}">
                            {{ $log->prediction }}
                        </span>
                    </td>
                    <td>{{ $log->recorded_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Map & Chart -->
<div class="row">
    <div class="col-md-12">
        <div id="map" style="height: 350px;" class="rounded shadow"></div>
    </div>
    <!-- <div class="col-md-6">
        <canvas id="tempChart" class="bg-white rounded shadow p-2"></canvas>
    </div> -->
</div>
@endsection

@section('scripts')
<script>
    const map = L.map('map').setView([19.0760, 72.8777], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    @if($logs->count() > 0)
        const last = @json($logs->first());
        if (last.latitude && last.longitude) {
            L.marker([last.latitude, last.longitude])
                .addTo(map)
                .bindPopup(`${last.city}: ${last.temperature}°C — ${last.prediction}`)
                .openPopup();
            map.setView([last.latitude, last.longitude], 8);
        }
    @endif
</script>
@endsection

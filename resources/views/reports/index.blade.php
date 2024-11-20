@extends('layouts.app')

@section('title', 'Annual Reports')
@section('name', 'Annual Reports Overview')

@section('content')
    @include('layouts.back')

    <div class="bg-white shadow-md rounded-lg mb-4 p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Annual Reports Overview</h2>

        <!-- Responsive container for the chart -->
        <div class="w-full h-96 sm:h-80 md:h-96 lg:h-96 xl:h-[30rem]">
            <canvas id="annualChart"></canvas>
        </div>

        <p class="mt-4 text-sm text-gray-600">
            This chart displays the aggregated performance data for the year. Use this to compare annual trends and understand the yearly performance of your metrics.
        </p>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('annualChart').getContext('2d');
            var annualChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($data['labels']),
                    datasets: [{
                        label: 'Annual Report Data',
                        data: @json($data['values']),
                        borderColor: '#60A5FA',
                        backgroundColor: 'rgba(96, 165, 250, 0.2)',
                        tension: 0.3,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                },
            });
        </script>
    </div>
@endsection

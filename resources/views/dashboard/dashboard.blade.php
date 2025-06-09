@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Post Bulan Ini</h5>
                        <h2 class="card-text">{{ $monthlyPostCount }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Semua Post</h5>
                        <h2 class="card-text">{{ $totalPostCount }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rata-rata Jumlah Kata per Post</h5>
                        <h2 class="card-text">{{ $averageWordCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-header">
                        Post Per-Kategori
                    </div>
                    <div class="card-body">
                        <canvas id="categoryPieChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header">
                        5 Post Terbaru Anda
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($recentPosts as $post)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $post->title }}</strong>
                                        <div class="text-muted">{{ $post->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    <span class="badge bg-primary">{{ $post->category->name ?? 'Tanpa Kategori' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('categoryPieChart').getContext('2d');

        const categoryPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($postsByCategory->keys()) !!},
                datasets: [{
                    label: 'Jumlah Post',
                    data: {!! json_encode($postsByCategory->values()) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection

@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-white">
            <h2 class="text-3xl font-bold">Analytics Dashboard</h2>
            <p class="text-indigo-100">Selamat datang, {{ auth()->user()->name }}! Lihat performa portal berita kamu di sini.</p>
        </div>
    </div>

    <!-- Stats Cards Row 1 -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Berita -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Berita</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalNews }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Published News -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Published</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ $publishedNews }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Draft News -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Draft</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ $draftNews }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Views</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($totalViews) }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row 2 (Admin Only) -->
    @if(auth()->user()->isAdmin())
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-pink-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Kategori</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalCategories }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Tags -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Tags</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-bold text-gray-900">{{ $totalTags }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Monthly Growth -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">📈 Pertumbuhan Bulanan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded">
                    <p class="text-sm text-gray-500">Bulan Ini</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $thisMonth }}</p>
                    <p class="text-xs text-gray-500">berita</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded">
                    <p class="text-sm text-gray-500">Bulan Lalu</p>
                    <p class="text-3xl font-bold text-gray-600">{{ $lastMonth }}</p>
                    <p class="text-xs text-gray-500">berita</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded">
                    <p class="text-sm text-gray-500">Pertumbuhan</p>
                    <p class="text-3xl font-bold {{ $monthlyGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $monthlyGrowth >= 0 ? '+' : '' }}{{ $monthlyGrowth }}%
                    </p>
                    <p class="text-xs text-gray-500">vs bulan lalu</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Statistics Section (Admin Only) -->
    @if(auth()->user()->isAdmin())
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">👥 Statistik Pengunjung (30 Hari Terakhir)</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="text-center p-4 bg-indigo-50 rounded shadow-sm">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Hari Ini</p>
                    <p class="text-2xl font-bold text-indigo-600 mt-1">{{ number_format($visitorToday) }}</p>
                    <p class="text-xxs text-gray-400 mt-1">pengunjung unik</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded shadow-sm">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Minggu Ini</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ number_format($visitorWeek) }}</p>
                    <p class="text-xxs text-gray-400 mt-1">pengunjung unik</p>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded shadow-sm">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Bulan Ini</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-1">{{ number_format($visitorMonth) }}</p>
                    <p class="text-xxs text-gray-400 mt-1">pengunjung unik</p>
                </div>
                <div class="text-center p-4 bg-red-50 rounded shadow-sm">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Tahun Ini</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">{{ number_format($visitorYear) }}</p>
                    <p class="text-xxs text-gray-400 mt-1">pengunjung unik</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded shadow-sm col-span-2 md:col-span-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Total</p>
                    <p class="text-2xl font-bold text-purple-600 mt-1">{{ number_format($visitorTotal) }}</p>
                    <p class="text-xxs text-gray-400 mt-1">sejak awal</p>
                </div>
            </div>
            
            <div class="mt-4" style="position: relative; height: 300px;">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>
    </div>
    @endif

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- News by Category Chart -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4">📊 Berita per Kategori</h3>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- News by Status Pie Chart -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4">📈 Status Berita</h3>
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- News per Month Line Chart -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">📉 Tren Berita (6 Bulan Terakhir)</h3>
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <!-- Top Content Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top 5 Most Viewed News -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4">🔥 Top 5 Berita Terpopuler</h3>
                @if($topNews->count() > 0)
                    <div class="space-y-3">
                        @foreach($topNews as $index => $news)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100 transition">
                                <div class="flex items-center space-x-3">
                                    <span class="flex-shrink-0 w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1">
                                        <p class="font-medium text-sm">{{ Str::limit($news->title, 50) }}</p>
                                        <p class="text-xs text-gray-500">{{ $news->published_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <span class="flex-shrink-0 px-3 py-1 text-sm font-bold text-purple-600 bg-purple-100 rounded-full">
                                    {{ number_format($news->views) }} views
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada data views</p>
                @endif
            </div>
        </div>

        <!-- Top Tags -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4">🏷️ Top 10 Tags Terpopuler</h3>
                @if($topTags->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($topTags as $tag)
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                #{{ $tag->name }}
                                <span class="ml-2 px-2 py-0.5 bg-indigo-200 rounded-full text-xs">{{ $tag->news_count }}</span>
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada tags</p>
                @endif
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
    <!-- Top Writers -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">✍️ Top 5 Penulis Teraktif</h3>
            @if($topWriters->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    @foreach($topWriters as $index => $writer)
                        <div class="text-center p-4 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg">
                            <div class="w-12 h-12 bg-indigo-500 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-2">
                                {{ substr($writer->name, 0, 1) }}
                            </div>
                            <p class="font-medium text-sm">{{ Str::limit($writer->name, 20) }}</p>
                            <p class="text-2xl font-bold text-indigo-600">{{ $writer->news_count }}</p>
                            <p class="text-xs text-gray-500">berita</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada data</p>
            @endif
        </div>
    </div>
    @endif

    <!-- Recent News -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">📰 Berita Terbaru</h3>

            @if($recentNews->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentNews as $news)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($news->title, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded bg-gray-100">{{ $news->category->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $news->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($news->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $news->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada berita</p>
            @endif
        </div>
    </div>

    <!-- Recent Comments -->
    @if(auth()->user()->isAdmin() || auth()->user()->isPenulis())
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-bold mb-4">💬 Komentar Terbaru</h3>

            @if($recentComments->count() > 0)
                <div class="space-y-4">
                    @foreach($recentComments as $comment)
                        <div class="border-l-4 border-blue-500 pl-4 py-3 bg-gray-50 rounded">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium text-sm text-gray-900">{{ $comment->user->name }}</span>
                                    <span class="text-xs text-gray-500">di</span>
                                    <span class="font-medium text-sm text-blue-600">{{ Str::limit($comment->news->title, 30) }}</span>
                                </div>
                                <span class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <p class="text-sm text-gray-700">{{ Str::limit($comment->content, 100) }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada komentar</p>
            @endif
        </div>
    </div>
    @endif
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // News by Category Bar Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($newsByCategory->pluck('name')) !!},
            datasets: [{
                label: 'Jumlah Berita',
                data: {!! json_encode($newsByCategory->pluck('news_count')) !!},
                backgroundColor: 'rgba(99, 102, 241, 0.5)',
                borderColor: 'rgb(99, 102, 241)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // News by Status Pie Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Published', 'Draft'],
            datasets: [{
                data: [{{ $newsByStatus['published'] }}, {{ $newsByStatus['draft'] }}],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.5)',
                    'rgba(251, 191, 36, 0.5)'
                ],
                borderColor: [
                    'rgb(34, 197, 94)',
                    'rgb(251, 191, 36)'
                ],
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

    // News per Month Line Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($newsPerMonth->pluck('month')) !!},
            datasets: [{
                label: 'Jumlah Berita',
                data: {!! json_encode($newsPerMonth->pluck('total')) !!},
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Visitor Chart (Admin Only)
    @if(auth()->user()->isAdmin())
    const visitorCtx = document.getElementById('visitorChart').getContext('2d');
    new Chart(visitorCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(collect($visitorChart)->pluck('label')) !!},
            datasets: [{
                label: 'Pengunjung Unik',
                data: {!! json_encode(collect($visitorChart)->pluck('total')) !!},
                borderColor: 'rgb(79, 70, 229)',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
    @endif
</script>
@endsection
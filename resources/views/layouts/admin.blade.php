{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Poros-KieRaha') }} - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('assets/img/logo/favicon/site.webmanifest') }}" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                                📰 News Portal
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                Dashboard
                            </a>

                            <a href="{{ route('admin.news.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.news.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                Berita
                            </a>
                            <a href="{{ route('admin.tags.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.tags.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                Tags
                            </a>

                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.banners.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.banners.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                <i class="fas fa-image mr-1"></i> Iklan Header
                            </a>
                            @endif
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.ads.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.ads.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                <i class="fas fa-image mr-1"> </i> Iklan
                            </a>
                            @endif

                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.categories.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.categories.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                Kategori
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.users.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} text-sm font-medium">
                                Users
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-700">
                                    {{ auth()->user()->name }}
                                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>
                                </span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-700 hover:text-gray-900">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Poros-KieRaha') }} - Admin</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('assets/img/logo/favicon/site.webmanifest') }}" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Sidebar Animation */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        
        @media (max-width: 768px) {
            .sidebar-closed {
                transform: translateX(-100%);
            }
        }

        /* Menu Item Hover Effect */
        .menu-item {
            position: relative;
            overflow: hidden;
        }
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, #4F46E5, #7C3AED);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        .menu-item:hover::before,
        .menu-item.active::before {
            transform: scaleY(1);
        }

        /* Badge Pulse Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Mobile Menu Toggle Button */
        .mobile-menu-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 50;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Overlay */
        .sidebar-overlay {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            pointer-events: none;
        }
        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 shadow-2xl transform lg:translate-x-0 sidebar-closed lg:static">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-gray-900/50 backdrop-blur border-b border-gray-700">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo" class="h-10 transition-transform group-hover:scale-110">
                    <span class="text-white font-bold text-lg hidden sm:block">Admin Panel</span>
                </a>
                <button id="closeSidebar" class="lg:hidden text-gray-400 hover:text-white transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Sidebar Content -->
            <div class="flex flex-col h-[calc(100vh-4rem)] overflow-y-auto">
                <!-- User Info Card -->
                <div class="p-4 m-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white truncate">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-indigo-100">
                                {{ ucfirst(auth()->user()->role) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 pb-4 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('dashboard') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-home w-5 text-center mr-3 {{ request()->routeIs('dashboard') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Dashboard</span>
                    </a>

                    @if(auth()->user()->isAdmin() || auth()->user()->isPenulis())
                    <!-- Berita -->
                    <a href="{{ route('admin.news.index') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('admin.news.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-newspaper w-5 text-center mr-3 {{ request()->routeIs('admin.news.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Kelola Berita</span>
                        @php
                            $draftCount = \App\Models\News::where('status', 'draft')->count();
                        @endphp
                        @if($draftCount > 0)
                        <span class="ml-auto bg-yellow-500 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full badge-pulse">
                            {{ $draftCount }}
                        </span>
                        @endif
                    </a>
                    @endif

                    @if(auth()->user()->isAdmin())
                    <!-- Kategori -->
                    <a href="{{ route('admin.categories.index') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('admin.categories.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-folder w-5 text-center mr-3 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Kategori</span>
                    </a>

                    <!-- Tags -->
                    <a href="{{ route('admin.tags.index') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('admin.tags.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-tags w-5 text-center mr-3 {{ request()->routeIs('admin.tags.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Tags</span>
                    </a>

                    <!-- Divider -->
                    <div class="my-4 border-t border-gray-700"></div>
                    <p class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tampilan & Iklan</p>

                    <!-- Banner Header -->
                    <a href="{{ route('admin.banners.index') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('admin.banners.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-image w-5 text-center mr-3 {{ request()->routeIs('admin.banners.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Banner Header</span>
                        @php
                            $activeBannersCount = \App\Models\Banner::active()->count();
                        @endphp
                        @if($activeBannersCount > 0)
                        <span class="ml-auto bg-green-500 text-green-900 text-xs font-bold px-2 py-1 rounded-full">
                            {{ $activeBannersCount }}
                        </span>
                        @endif
                    </a>

                    <!-- Iklan -->
                    <a href="{{ route('admin.ads.index') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('admin.ads.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-ad w-5 text-center mr-3 {{ request()->routeIs('admin.ads.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Kelola Iklan</span>
                        @php
                            $activeAdsCount = \App\Models\Ad::active()->count();
                        @endphp
                        @if($activeAdsCount > 0)
                        <span class="ml-auto bg-green-500 text-green-900 text-xs font-bold px-2 py-1 rounded-full">
                            {{ $activeAdsCount }}
                        </span>
                        @endif
                    </a>

                    <!-- Divider -->
                    <div class="my-4 border-t border-gray-700"></div>
                    <p class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengaturan</p>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('admin.users.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-users w-5 text-center mr-3 {{ request()->routeIs('admin.users.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Kelola Users</span>
                    </a>
                    @endif

                    <!-- Divider -->
                    <div class="my-4 border-t border-gray-700"></div>

                    <!-- Lihat Website -->
                    <a href="{{ route('home') }}" target="_blank"
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-green-800/30 hover:text-green-400 rounded-lg transition-all group">
                        <i class="fas fa-globe w-5 text-center mr-3 group-hover:text-green-400"></i>
                        <span>Lihat Website</span>
                        <i class="fas fa-external-link-alt ml-auto text-xs opacity-50"></i>
                    </a>

                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}" 
                       class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800/50 hover:text-white rounded-lg transition-all group {{ request()->routeIs('profile.*') ? 'active bg-gray-800 text-white font-semibold' : '' }}">
                        <i class="fas fa-user-cog w-5 text-center mr-3 {{ request()->routeIs('profile.*') ? 'text-indigo-400' : 'group-hover:text-indigo-400' }}"></i>
                        <span>Profile</span>
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="menu-item w-full flex items-center px-4 py-3 text-gray-300 hover:bg-red-800/30 hover:text-red-400 rounded-lg transition-all group">
                            <i class="fas fa-sign-out-alt w-5 text-center mr-3 group-hover:text-red-400"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </nav>

                <!-- Footer -->
                <div class="p-4 border-t border-gray-700">
                    <p class="text-xs text-gray-500 text-center">
                        © {{ date('Y') }} Poros Kieraha<br>
                        <span class="text-gray-600">v1.0.0</span>
                    </p>
                </div>
            </div>
        </aside>

        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-30 lg:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 z-10">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile Menu Button -->
                        <button id="openSidebar" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg p-2">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        
                        <!-- Page Title -->
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">
                            @yield('page-title', 'Dashboard')
                        </h1>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-3">
                        <!-- Notifications (Optional) -->
                        <button class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition hidden sm:block">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Quick Actions -->
                        <a href="{{ route('admin.news.create') }}" 
                           class="hidden sm:flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Berita
                        </a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                <!-- Alert Messages -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded shadow-sm animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded shadow-sm animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded shadow-sm">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mr-3 text-red-500 mt-1"></i>
                        <div>
                            <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
                    <p>© {{ date('Y') }} Poros Kieraha. All rights reserved.</p>
                    <p class="mt-2 sm:mt-0">Developed by <span class="font-semibold text-indigo-600">Heartware Digital</span></p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Floating Action Button -->
    <button id="mobileFAB" class="mobile-menu-button lg:hidden bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-lg transition-transform hover:scale-110">
        <i class="fas fa-plus text-xl"></i>
    </button>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtn = document.getElementById('openSidebar');
            const closeBtn = document.getElementById('closeSidebar');
            const mobileFAB = document.getElementById('mobileFAB');

            // Open Sidebar
            function openSidebar() {
                sidebar.classList.remove('sidebar-closed');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Close Sidebar
            function closeSidebar() {
                sidebar.classList.add('sidebar-closed');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            // Event Listeners
            if (openBtn) openBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);

            // Mobile FAB - Quick Create News
            if (mobileFAB) {
                mobileFAB.addEventListener('click', function() {
                    window.location.href = "{{ route('admin.news.create') }}";
                });
            }

            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.animate-fade-in');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
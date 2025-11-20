{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login Poros KieRaha</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo/favicon/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/favicon/apple-touch-icon.png') }}" />
        <link rel="manifest" href="{{ asset('assets/img/logo/favicon/site.webmanifest') }}" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Selamat Di Poros Kie Raha</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo/favicon/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/favicon/apple-touch-icon.png') }}" />
        <link rel="manifest" href="{{ asset('assets/img/logo/favicon/site.webmanifest') }}" />
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Left Side - Form -->
            <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div class="w-full max-w-md">
                    <!-- Logo -->
                    <div class="text-center mb-8">
                        <br>
                        <a href="/" class="inline-block">
                            <img src="{{ asset('assets/img/logo/poros fix.PNG') }}" alt="Logo"
                            style="height: 70px;">
                            {{-- <x-application-logo class="w-16 h-16 mx-auto fill-current text-gray-800" /> --}}
                        </a>
                        {{-- <h2 class="mt-4 text-2xl font-bold text-gray-900">Poros KieRaha</h2> --}}
                    </div>

                    <!-- Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Right Side - Image/Pattern (Hidden on mobile) -->
            <div class="hidden lg:flex lg:flex-1 bg-gray-900 items-center justify-center p-12">
                <div class="max-w-md text-center">
                    <div class="w-32 h-32 mx-auto mb-8 bg-white/10 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">Selamat Datang</h3>
                    <p class="text-gray-400 text-lg">Kelola sistem dengan mudah dan aman</p>
                </div>
            </div>
        </div>
    </body>
</html>
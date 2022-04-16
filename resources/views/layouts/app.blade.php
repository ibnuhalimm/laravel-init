<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ config('app.name', 'Laravel') }}
        @hasSection ('title')
            | @yield('title')
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin>
    <link rel="preconnect" href="https://cdn.datatables.net/" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net/">
    <link rel="dns-prefetch" href="https://cdn.datatables.net/">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    @stack('top_css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('bottom_css')

    @routes
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('top_js')
</head>
<body class="font-sans antialiased text-sm">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.sidebar-navigation')

        <div class="xl:ml-60">
            <div class="w-full 2xl:max-w-6xl 2xl:mx-auto 2xl:pl-12">
                <header class="mb-0">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <ul class="breadcrumb w-full px-2">
                            <x-tabuna-breadcrumbs class="inline text-blue-500 after:content-['»'] last:after:content-[''] after:px-2 after:text-gray-400" />
                        </ul>
                    </div>
                </header>
                <main class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/dodo-modal.js?_=' . rand()) }}"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    @stack('bottom_js')
</body>
</html>

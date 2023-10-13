<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Curatech ERP') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/87011d2ad4.js" crossorigin="anonymous"></script>

    <!-- Set x-cloak to not display to prevent modals from showing on initial page load/reload
        Defining it here sets the attribute before css files can be loaded, since these load after the page is initialized
    -->
        <style>
            [x-cloak] { display: none !important; }

            .htmx-indicator {
                display: none;
            }
            .htmx-request{
                display:block;
            }
        </style>

        <script lang="text/javascript">
            function browseTo(url) {
                window.location.href = url;
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-screen">
        <div class="min-h-screen bg-cbg-100 dark:bg-cbg-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-cbg-200 dark:bg-cbg-800 shadow">
                    <div class="flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl text-primary">{{substr($header->toHtml(), 0, 1)}}</h1>
                        <h1 class="text-3xl text-dark dark:text-white">
                        {{substr($header->toHtml(), 1)}}
                        </h1>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-6 px-2 max-w-7xl mx-auto">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

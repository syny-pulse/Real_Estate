<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PropertyFinder') }} - @yield('title', 'Find Your Dream Home')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" <div class="flex min-h-screen">
    <aside class="w-64 bg-white shadow-md">
        @yield('sidebar')
    </aside>

    <main class="flex-1 p-6">
        @yield('content')
    </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    </body>

</html>

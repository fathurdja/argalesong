<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-200 min-h-screen flex flex-col">
    @include('partials.navbar')
    <div class="flex flex-1 overflow-hidden">
        @include('partials.sidebar')
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-4">
            <div class="container mx-auto px-4 sm:px-8 ">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('script')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

</body>

</html>

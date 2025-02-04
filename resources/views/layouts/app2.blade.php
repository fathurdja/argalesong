<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>

    <!-- Tambahkan CSS Anda di sini -->
    {{-- @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js']) --}}
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js',])
</head>

<body class=" bg-gray-100 dark:bg-gray-900 w-full h-full">

    <div class="flex h-screen bg-gray-200">

        @include('partials.sidebar')

        <div class="flex-1 px-20">
            @yield('content')
        </div>
    </div>
    @stack('script')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

</body>

</html>

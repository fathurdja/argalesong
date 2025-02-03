<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>

    <!-- Tambahkan CSS Anda di sini -->
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
    {{-- @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/test.js']) --}}

    {{-- tambahanan mengganti isi dari bukanPelanggan.blade --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class=" bg-gray-100 dark:bg-gray-900 w-full h-full">

    <div class="flex h-screen bg-gray-200">

        @include('partials.sidebar')

        <div class="flex-1 px-20">
            @yield('content')
        </div>
    </div>
    @stack('scripts')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

</body>



</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-1\00 min-h-screen flex flex-col">
    @include('partials.navbar')
    <div class="flex flex-1 ">
        @include('partials.sidebar')
        <main class="flex justify-start items-center flex-col lg:bg-gray-100 bg-white px-2 md:px-20 w-full max-w-full overflow-x-hidden">
            <div class="w-full max-w-full flex items-center justify-center py-10">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

</body>

</html>

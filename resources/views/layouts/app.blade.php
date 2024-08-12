<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Tambahkan CSS Anda di sini -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" bg-gray-100 dark:bg-gray-900 w-full h-full">
    @include('partials.navbar')
    <div class="flex h-screen bg-gray-200">

        @include('partials.sidebar')

        <div class="flex-1 px-20">
            @yield('content')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const arrows = document.querySelectorAll('.arrow');
            const sidebar = document.querySelector('.sidebar');

            arrows.forEach(arrow => {
                arrow.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent click event from propagating to parent elements
                    const submenu = this.closest('li').querySelector('.sidebar-submenu');
                    submenu.classList.toggle('active');
                });
            });

            sidebar.addEventListener('mouseleave', function() {
                document.querySelectorAll('.sidebar-submenu').forEach(submenu => {
                    submenu.classList.remove('active');
                });
            });
        });
    </script>
</body>

</html>

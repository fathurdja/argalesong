<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="w-full h-full bg-slate-600">
    <form class="max-w-screen-lg  mx-auto bg-white px-5 py-2 rounded-md mt-2 "
        action="{{ route('makeAccount') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center mb-3">
            <img src="{{ asset('assets/logo/galesong.png') }}" alt="" class="w-12 h-12">
        </div>
        <div class="flex justify-center mb-3">
            <h1 class="text-xl">Daftar Akun</h1>
        </div>
        <div class="mb-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
            <input type="text" id="name" name="name"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.2"
                required />
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                email</label>
            <input type="email" id="email" name="email"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.2"
                required />
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                Departemen</label>
            <input type="text" id="departemen" name="departemen"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.2"
                required />
            @error('departemen')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                password</label>
            <input type="password" id="password" name="password"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.2"
                required />
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-2">
            <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat
                password</label>
            <input type="password" id="repeat-password" name="password_confirmation"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required />
        </div>
        <div class="mb-2">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image
                Photo</label>
            <input type="file" id="image" name="image"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full"
                required />
            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-start mb-4">
            <div class="flex items-center h-5">
                <input id="terms" type="checkbox" value=""
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
            </div>
            <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a
                    href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and
                    conditions</a></label>
        </div>
        <button type="submit"
            class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register
            new account</button>
    </form>


</body>

</html>

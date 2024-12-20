<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-800">
        <div class="w-96 p-6 shadow-lg bg-white rounded-md">
            <h1 class="text-3xl block text-center font-semibold">AR Finance</h1>
            <p class="text-sm block text-center font-semibold">Galesong </p>
            <hr class="mt-3">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="user" class="block text-base mb-2">email</label>
                    <input type="text" id="user" name="email" value=""
                        class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600 "
                        placeholder="Enter email" />
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="password" class="block text-base mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600"
                        placeholder="Enter Password..." />
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3 flex justify-between items-center">
                    <div>
                        <input type="checkbox" name="remember">
                        <label>Remember Me</label>
                    </div>
                    <div>
                        <a href="#" class="text-indigo-800 font-semibold">Forgot Password?</a>
                    </div>
                </div>
                <div class="mt-5 bg-gray-800">
                    <button type="submit"
                        class="border-2   text-white py-1 w-full  hover:text-indigo-700 font-semibold">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        &nbsp;&nbsp;Login
                    </button>
                </div>
                <div class="text-center mt-3 bg-gray-800 p-1 border-2 ">
                    <a href="{{ route('register') }}"
                        class="text-white hover:text-blue-900 hover:underline  w-full  font-semibold">Daftar
                        Akun</a>
                </div>
                @if ($errors->has('email'))
                    <div class="mt-3 text-red-600 text-sm">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </form>


        </div>
    </div>

</body>

</html>

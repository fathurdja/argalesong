<header>
    <nav class="bg-gray-300 border-gray-200 px-4 py-2 dark:bg-gray-800 w-full flex flex-row justify-evenly">
        <div class="container mx-auto flex flex-wrap items-center justify-between px-4 md:px-6">
            <div class="flex items-center space-x-3">
                <a href="" class="flex items-center">
                    <div class="flex flex-col">
                        <span class=" text-sm md:text-xl font-semibold dark:text-white">
                            FINANCE ACCOUNTING (FA)
                        </span>
                        <span class="text-xs md:text-sm font-thin dark:text-gray-400">APPLICATION FOR FINANCE</span>
                    </div>
                </a>
            </div>

            <div class="flex flex-col text-center md:text-left md:flex-row md:items-center md:space-x-6">
                <span class="text-sm font-semibold text-blue-700 hover:underline">
                    {{-- Departemen {{ Auth::user()->departemen }} --}}
                </span>
                <p class="text-xs md:text-sm">@php echo date('l, d-m-Y'); @endphp</p>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <span class="text-sm">AREA KERJA</span>
                <span class="text-sm underline font-medium">
                    {{-- {{ Auth::user()->name }} --}}
                    name
                </span>
            </div>
        </div>
        <div class="md:hidden">
            <div class="">
                <h2>Username</h2>
                <h3>Accounting</h3>
            </div>
            <div class=""></div>
        </div>
    </nav>
</header>

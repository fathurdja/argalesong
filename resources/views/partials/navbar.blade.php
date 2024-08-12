<header>
    <nav class="bg-white border-gray-200 px-4 py-2 dark:bg-gray-800 w-full">
        <div class="flex justify-between items-center ml-60 max-w-screen-xl">
            <div class="flex items-center space-x-3">
                <a href="https://flowbite.com" class="flex items-center">

                    <div class="flex flex-col">
                        <span class="self-center text-xl font-semibold dark:text-white">
                            FINANCE ACCOUNTING (FA)
                        </span>
                        <span class="text-sm font-thin dark:text-gray-400">APPLICATION FOR FINANCE</span>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-8">
                <span class="text-sm ">AREA KERJA</span>
                <span class="text-sm underline font-medium text-center">{{ Auth::user()->name }}</span>

                <img src="https://engineering.unl.edu/images/staff/Kayla-Person.jpg" alt="Profile Picture"
                    class="w-12 h-12 rounded-full mx-auto">
            </div>
        </div>
    </nav>


</header>

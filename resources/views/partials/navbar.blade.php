<link rel="stylesheet" href="custom.css">

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
        {{-- <div class="md:hidden">
            <div class="">
                <h2>Username</h2>
                <h3>Accounting</h3>
            </div>
            <div class=""></div>
        </div> --}}
        <button id="menu-humburger" class="md:hidden  w-8  flex flex-col justify-center items-end gap-[3px] group">
            <span
                class="block w-full h-1 bg-gray-800 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
            <span
                class="block w-[90%] h-1 bg-gray-800 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
            <span
                class="block w-full h-1 bg-gray-800 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
            <span
                class="block w-[90%] h-1 bg-gray-800 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
        </button>
    </nav>


</header>

<script>
    document.getElementById('menu-humburger').addEventListener('click', (e) => {
    e.preventDefault();
    e.currentTarget.classList.toggle('humburger');
    const aside = document.getElementById('aside');
    const subMenut = document.querySelector('.sidebar .sidebar-item .text')
    const subMenut2 = document.querySelector('#aside .sidebar-submenu')
    console.log('hello word')
    console.log(subMenut2);
    aside.classList.toggle('hidden');
// aside.classList.toggle('ml-2');
subMenut.classList.toggle('opacity-170');
subMenut.classList.toggle('ml-2');
subMenut2.classList.toggle('block');




});
</script>


<style>
    
</style>
{{-- .sidebar:hover .sidebar-item .text {
    opacity: 1;
    margin-left: 1rem;
} --}}
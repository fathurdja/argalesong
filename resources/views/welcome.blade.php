<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    

  

    <style>
        .sidebar {
            width: 4rem;
            transition: width 0.3s;
        }

        .sidebar:hover {
            width: 15rem;
        }

        .sidebar-item {
            position: relative;
            display: flex;
            align-items: center;
        }

        .sidebar-submenu {
            display: none;
            position: relative;
            align-items: center;
        }

        .sidebar-item .text {
            opacity: 0;
            white-space: nowrap;
            transition: opacity 0.3s;
            margin-left: 0.5rem;
        }

        .sidebar:hover .sidebar-item .text {
            opacity: 1;
            margin-left: 1rem;
        }

        .sidebar .sidebar-submenu.active {
            display: block;
        }

        .sidebar-submenu-item {
            padding-left: 3rem;
        }

        .arrow {
            margin-left: auto;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen bg-gray-900">
        <aside class="sidebar fixed inset-y-0 left-0 bg-white border-r dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-center h-16 shadow-md">
                <button class="p-2 text-gray-500 rounded-md focus:outline-none focus:ring">
                    <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <nav class="px-4 py-2">
                <ul class="space-y-2">
                    <li
                        class="sidebar-item p-2 text-gray-700 rounded-md dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="1em"
                            height="1em" viewBox="0 0 24 24">
                            <path fill="black" d="M3 21V3h18v18zm2-2h6V5H5zm8 0h6v-7h-6zm0-9h6V5h-6z" />
                        </svg>
                        <span class="text">Dashboard</span>
                    </li>
                </ul>
                <div class="sidebar-item text-sm pt-4">
                    <h3 class="font-bold text">Dept.Finance</h3>
                </div>
                <ul class="space-y-2">
                    <li>
                        <div
                            class="sidebar-item flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                <g fill="none">
                                    <rect width="18" height="15" x="3" y="6" stroke="black" rx="2" />
                                    <path fill="black"
                                        d="M3 10c0-1.886 0-2.828.586-3.414S5.114 6 7 6h10c1.886 0 2.828 0 3.414.586S21 8.114 21 10z" />
                                    <path stroke="black" stroke-linecap="round" d="M7 3v3m10-3v3" />
                                    <rect width="4" height="2" x="7" y="12" fill="black" rx=".5" />
                                    <rect width="4" height="2" x="7" y="16" fill="black" rx=".5" />
                                    <rect width="4" height="2" x="13" y="12" fill="black" rx=".5" />
                                    <rect width="4" height="2" x="13" y="16" fill="black" rx=".5" />
                                </g>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap text">Account Receive</span>
                            <svg aria-hidden="true" class="arrow w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <ul class="py-2  text sidebar-submenu">
                            <li class="sidebar-submenu-item">
                                <a href="#"
                                    class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tambah
                                    Piutang</a>
                            </li>
                            <li class="sidebar-submenu-item">
                                <a href="#"
                                    class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Semua
                                    Data</a>
                            </li>
                            <li class="sidebar-submenu-item">
                                <a href="#"
                                    class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kartu
                                    Piutang</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 p-4">
            <!-- Main content -->
        </div>
    </div>

   
</body>

</html>

<aside
    class="sidebar fixed inset-y-0 left-0 bg-white border-r dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-center h-16 shadow-md">
            <a class="p-2 text-gray-500" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/logo/galesong.png') }}" alt="" class="w-9 h-9">
            </a>
        </div>
        <nav class="px-4 py-2">
            <ul class="space-y-2">
                <a href="{{ route('dashboard') }}">
                    <li
                        class="sidebar-item p-2 text-gray-700 rounded-md dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 1024 1024" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M455.253333 124.629333a37.461333 37.461333 0 0 0-37.461333-37.461333H124.629333a37.461333 37.461333 0 0 0-37.461333 37.461333v293.162667c0 20.693333 16.768 37.461333 37.461333 37.461333h293.162667a37.461333 37.461333 0 0 0 37.461333-37.461333V124.629333z" />
                            <path
                                d="M901.290667 87.210667a37.802667 37.802667 0 0 1 35.498666 35.498666c2.517333 98.944 2.517333 198.058667 0 297.002667a37.802667 37.802667 0 0 1-35.498666 35.498667 5987.968 5987.968 0 0 1-297.002667 0 37.802667 37.802667 0 0 1-35.498667-35.498667 5841.152 5841.152 0 0 1 0-297.002667 37.802667 37.802667 0 0 1 35.498667-35.498666c98.944-2.517333 198.058667-2.517333 297.002667 0z m-288.085334 44.416v279.168h279.168V131.626667h-279.168zM419.712 568.789333a37.802667 37.802667 0 0 1 35.498667 35.498667c2.517333 98.944 2.517333 198.058667 0 297.002667a37.802667 37.802667 0 0 1-35.498667 35.498666c-98.944 2.517333-198.058667 2.517333-297.002667 0a37.802667 37.802667 0 0 1-35.498666-35.498666 5841.152 5841.152 0 0 1 0-297.002667 37.802667 37.802667 0 0 1 35.498666-35.498667c98.944-2.517333 198.058667-2.517333 297.002667 0z m-288.085333 44.416v279.168h279.168v-279.168H131.626667zM901.290667 568.789333a37.802667 37.802667 0 0 1 35.498666 35.498667c2.517333 98.944 2.517333 198.058667 0 297.002667a37.802667 37.802667 0 0 1-35.498666 35.498666c-98.944 2.517333-198.058667 2.517333-297.002667 0a37.802667 37.802667 0 0 1-35.498667-35.498666 5841.152 5841.152 0 0 1 0-297.002667 37.802667 37.802667 0 0 1 35.498667-35.498667c98.944-2.517333 198.058667-2.517333 297.002667 0z m-288.085334 44.416v279.168h279.168v-279.168h-279.168z" />
                        </svg>
                        <span class="text">Dashboard</span>
                    </li>
                </a>
            </ul>
            <ul class="space-y-2">
                <li>

                    <div
                        class="sidebar-item flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <path fill="black" fill-rule="evenodd"
                                d="M7.75 7.5a4.25 4.25 0 1 1 8.5 0a4.25 4.25 0 0 1-8.5 0M12 4.75a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5m-4 10A2.25 2.25 0 0 0 5.75 17v1.188c0 .018.013.034.031.037c4.119.672 8.32.672 12.438 0a.04.04 0 0 0 .031-.037V17A2.25 2.25 0 0 0 16 14.75h-.34a.3.3 0 0 0-.079.012l-.865.283a8.75 8.75 0 0 1-5.432 0l-.866-.283a.3.3 0 0 0-.077-.012zM4.25 17A3.75 3.75 0 0 1 8 13.25h.34q.28.001.544.086l.866.283a7.25 7.25 0 0 0 4.5 0l.866-.283c.175-.057.359-.086.543-.086H16A3.75 3.75 0 0 1 19.75 17v1.188c0 .754-.546 1.396-1.29 1.517a40.1 40.1 0 0 1-12.92 0a1.54 1.54 0 0 1-1.29-1.517z"
                                clip-rule="evenodd" />
                        </svg>


                        <a href="{{ route('daftarpelanggan') }}"> <span
                                class="flex-1 ml-3 text-left whitespace-nowrap text">Daftar Pelanggan</span></a>
                        <svg aria-hidden="true" class="arrow w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <ul class="py-2 text sidebar-submenu">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('daftarpelangganBaru') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Baru</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="space-y-2">
                <li>
                    <div
                        class="sidebar-item flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M755.2 938.666667H290.133333C224 938.666667 170.666667 885.333333 170.666667 819.2V204.8C170.666667 138.666667 224 85.333333 290.133333 85.333333h270.933334c10.666667 0 21.333333 4.266667 29.866666 12.8l270.933334 268.8c8.533333 8.533333 12.8 19.2 12.8 29.866667v422.4c0 66.133333-53.333333 119.466667-119.466667 119.466667zM290.133333 170.666667c-19.2 0-34.133333 14.933333-34.133333 34.133333v614.4c0 19.2 14.933333 34.133333 34.133333 34.133333h465.066667c19.2 0 34.133333-14.933333 34.133333-34.133333v-405.333333L544 170.666667H290.133333z" />
                            <path
                                d="M810.666667 448H554.666667c-23.466667 0-42.666667-19.2-42.666667-42.666667V149.333333c0-23.466667 19.2-42.666667 42.666667-42.666666s42.666667 19.2 42.666666 42.666666v213.333334h213.333334c23.466667 0 42.666667 19.2 42.666666 42.666666s-19.2 42.666667-42.666666 42.666667zM618.666667 682.666667H405.333333c-23.466667 0-42.666667-19.2-42.666666-42.666667s19.2-42.666667 42.666666-42.666667h213.333334c23.466667 0 42.666667 19.2 42.666666 42.666667s-19.2 42.666667-42.666666 42.666667z" />
                            <path
                                d="M512 789.333333c-23.466667 0-42.666667-19.2-42.666667-42.666666V533.333333c0-23.466667 19.2-42.666667 42.666667-42.666666s42.666667 19.2 42.666667 42.666666v213.333334c0 23.466667-19.2 42.666667-42.666667 42.666666z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap text">Piutang Baru</span>
                        <svg aria-hidden="true" class="arrow w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <ul class="py-2 text sidebar-submenu">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('afiliasi') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Afiliasi</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('sewa-menyewa') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Sewa
                                Menyewa</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="#"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Sharing
                                Revenue</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="space-y-2">
                <li>
                    <div
                        class="sidebar-item flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M735.500307 715.181539l81.273025 0c11.211343 0 20.317745-9.087982 20.317745-20.317745l0-81.273025c0-11.211343-9.106402-20.317745-20.317745-20.317745l-81.273025 0c-11.211343 0-20.317745 9.106402-20.317745 20.317745l0 81.273025C715.181539 706.093557 724.288964 715.181539 735.500307 715.181539M207.226668 633.909537l365.727589 0c11.211343 0 20.317745-9.087982 20.317745-20.317745 0-11.211343-9.106402-20.317745-20.317745-20.317745L207.226668 593.274048c-11.211343 0-20.317745 9.106402-20.317745 20.317745C186.908924 624.820532 196.015326 633.909537 207.226668 633.909537M207.226668 715.181539l284.454564 0c11.211343 0 20.317745-9.087982 20.317745-20.317745 0-11.211343-9.106402-20.317745-20.317745-20.317745L207.226668 674.54605c-11.211343 0-20.317745 9.106402-20.317745 20.317745C186.908924 706.093557 196.015326 715.181539 207.226668 715.181539M918.364101 186.908924 105.635899 186.908924c-22.430872 0-40.636512 18.195408-40.636512 40.636512l0 568.909128c0 22.421662 18.204617 40.636512 40.636512 40.636512l812.728202 0c22.430872 0 40.636512-18.21485 40.636512-40.636512L959.000614 227.545436C959.000614 205.104331 940.794973 186.908924 918.364101 186.908924M918.364101 796.454564 105.635899 796.454564 105.635899 471.363488l812.728202 0L918.364101 796.454564zM918.364101 308.818461 105.635899 308.818461 105.635899 227.545436l812.728202 0L918.364101 308.818461z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap text">Kartu Piutang</span>
                        <svg aria-hidden="true" class="arrow w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <ul class="py-2 text sidebar-submenu">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('kp-pelanggan') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Pelanggan</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('kp-bukanpelanggan') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Bukan
                                Pelanggan</a>
                        </li>

                    </ul>
                </li>
            </ul>
            <ul class="space-y-2">
                <a href="{{ route('umur-piutang') }}">
                    <li
                        class="sidebar-item p-2 text-gray-700 rounded-md dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M512 0C229.888 0 0 229.888 0 512s229.888 512 512 512 512-229.888 512-512S794.112 0 512 0z m442.368 512c0 243.712-198.144 442.368-442.368 442.368-243.712 0-442.368-198.144-442.368-442.368 0-243.712 198.144-442.368 442.368-442.368 243.712 0 442.368 198.656 442.368 442.368z" />
                            <path
                                d="M546.816 498.176V232.96c0-19.456-15.872-34.816-34.816-34.816-19.456 0-34.816 15.872-34.816 34.816v280.064c0 9.216 3.584 17.92 10.24 24.576l130.56 130.048c6.656 6.656 15.36 10.24 24.576 10.24 9.216 0 17.92-3.584 24.576-10.24 6.656-6.656 10.24-15.36 10.24-24.576 0-9.216-3.584-17.92-10.24-24.576l-120.32-120.32z" />
                        </svg>
                        <span class="text">Umur Piutang</span>
                    </li>
                </a>
            </ul>
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
                        <span class="flex-1 ml-3 text-left whitespace-nowrap text">Schedule Piutang</span>
                        <svg aria-hidden="true" class="arrow w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <ul class="py-2 text sidebar-submenu">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('sp-bulanan') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Bulanan</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('sp-harian') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Harian</a>
                        </li>

                    </ul>
                </li>
            </ul>
            <ul class="space-y-2">
                <li>
                    <div
                        class="sidebar-item flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 1024 1024" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M810.666667 128h-178.56c-17.493333-49.493333-64.426667-85.333333-120.106667-85.333333s-102.613333 35.84-120.106667 85.333333H213.333333c-47.146667 0-85.333333 38.186667-85.333333 85.333333v597.333334c0 47.146667 38.186667 85.333333 85.333333 85.333333h597.333334c47.146667 0 85.333333-38.186667 85.333333-85.333333V213.333333c0-47.146667-38.186667-85.333333-85.333333-85.333333zM554.666667 768h-85.333334v-85.333333h85.333334v85.333333z m0-170.666667h-85.333334V341.333333h85.333334v256z m-42.666667-384c-23.466667 0-42.666667-18.986667-42.666667-42.666666s19.2-42.666667 42.666667-42.666667 42.666667 18.986667 42.666667 42.666667-19.2 42.666667-42.666667 42.666666z" />
                        </svg>
                        <a href="{{ route('jatuh-tempo') }}"><span
                                class="flex-1 ml-3 text-left whitespace-nowrap text">Jatuh
                                Tempo</span></a>

                    </div>
                </li>
            </ul>
            <ul class="space-y-2">
                <li>
                    <div
                        class="sidebar-item flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M736.2 590.9H274.5c-16.6 0-30 13.4-30 30s13.4 30 30 30h461.8c16.6 0 30-13.4 30-30s-13.5-30-30.1-30z" />
                            <path d="M312.8 432.8m-61 0a61 61 0 1 0 122 0 61 61 0 1 0-122 0Z" />
                            <path
                                d="M815.3 155.3H206.6c-78 0-141.4 63.4-141.4 141.4v440.1c0 78 63.4 141.4 141.4 141.4h608.7c78 0 141.4-63.4 141.4-141.4V296.7c0.1-78-63.4-141.4-141.4-141.4z m81.9 581.5c0 45.2-36.7 81.9-81.9 81.9H206.6c-45.2 0-81.9-36.7-81.9-81.9V296.7c0-45.2 36.7-81.9 81.9-81.9h608.7c45.2 0 81.9 36.7 81.9 81.9v440.1z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap text">Pemutihan Piutang</span>
                        <svg aria-hidden="true" class="arrow w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <ul class="py-2 text sidebar-submenu">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('pp-pengajuan') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Pengajuan</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('pp-baru') }}"
                                class="flex items-center p-2 pl-4 w-full text-sm text font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 ">Baru</a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit"
            class="sidebar-item  pt-4 flex items-center p-4 w-full text-base font-normal text-gray-900 rounded-lg dark:text-white dark:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"
                class="w-6 h-6 flex-shrink-0">
                <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M6 6.5C4.159 8.148 3 10.334 3 13a9 9 0 1 0 18 0c0-2.666-1.159-4.852-3-6.5M12 2v9m0-9c-.7 0-2.008 1.994-2.5 2.5M12 2c.7 0 2.008 1.994 2.5 2.5"
                    color="black" />
            </svg>
            <h3 class="font-bold ml-2 text">Logout</h3>
        </button>
    </form>
</aside>

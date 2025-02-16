<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app2')

@section('content')
    <div
        class="flex flex-col sm:flex-row justify-center md:justify-evenly items-center bg-gray-100 
        
        rounded-lg max-w-full md:h-full gap-5 lg:gap-1 container p-4 ">
        <!-- Bagian Kiri: Informasi Perusahaan dan Pengguna -->
        <div class="text-center flex items-center justify-center flex-col gap-2 w-full md:w-auto">
            <h1 class="text-lg md:text-xl lg:text-2xl font-bold">PT SINAR GALESONG PRATAMA</h1>
            <h2 class="text-md md:text-lg lg:text-xl font-bold text-lg">Departemen <i>Accounting</i></h2>
            <div
                class="w-24 h-24 md:h-[163px] md:w-[153px] lg:h-[213px] lg:w-[203px] overflow-hidden flex items-center justify-center rounded-md">
                <img src="assets/logo/galesong.png" class="w-full h-full object-contain" alt="Foto Profile">
            </div>
            <h2 class="text-lg font-bold lg:text-xl">Hai <i>Username!</i></h2>
        </div>

        <!-- Bagian Kanan: Tanggal dan Tabel Umur Piutang -->
        <div class="text-right w-full md:w-auto">
            <!-- Tanggal -->
            <p class="text-gray-600 font-normal">{{ $currentDate }}</p>

            <!-- Tabel Umur Piutang -->
            <div class="overflow-x-auto w-full h-full md:w-auto">
                <h2 class="text-lg font-bold mb-2">Umur Piutang</h2>
                <table class="w-full bg-[#D8E2FD] border border-gray-200 px-1 py-1 rounded-md ">
                    <thead>
                        <tr>
                            <th
                                class="border border-gray-200 px-1 py-0 md:px-4 md:py-2 text-[#2E2659] text-center md:text-left">
                                No</th>
                            <th
                                class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-[#2E2659] text-center md:text-left">
                                Aging</th>
                            <th
                                class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-[#2E2659] text-center md:text-left">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summaryData as $row)
                            <tr class="font-medium ">
                                <td
                                    class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-black font-normal text-center md:text-left">
                                    {{ $row['no'] }}</td>
                                <td
                                    class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-black font-normal text-center md:text-left">
                                    {{ $row['aging'] }}</td>
                                <td
                                    class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-black font-normal text-center md:text-left">
                                    {{ 'Rp' . number_format($row['total'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <ul
                        class="justify-start pl-4 mt-10 lg:mt-0 items-start scroll-smooth py-1 w-full flex sm:hidden flex-row space-x-6 overflow-auto scrollbar-hide">
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class=" fill-white flex-shrink-0 w-6 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                            viewBox="0 0 24 24">
                                            <path fill="white" fill-rule="evenodd"
                                                d="M7.75 7.5a4.25 4.25 0 1 1 8.5 0a4.25 4.25 0 0 1-8.5 0M12 4.75a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5m-4 10A2.25 2.25 0 0 0 5.75 17v1.188c0 .018.013.034.031.037c4.119.672 8.32.672 12.438 0a.04.04 0 0 0 .031-.037V17A2.25 2.25 0 0 0 16 14.75h-.34a.3.3 0 0 0-.079.012l-.865.283a8.75 8.75 0 0 1-5.432 0l-.866-.283a.3.3 0 0 0-.077-.012zM4.25 17A3.75 3.75 0 0 1 8 13.25h.34q.28.001.544.086l.866.283a7.25 7.25 0 0 0 4.5 0l.866-.283c.175-.057.359-.086.543-.086H16A3.75 3.75 0 0 1 19.75 17v1.188c0 .754-.546 1.396-1.29 1.517a40.1 40.1 0 0 1-12.92 0a1.54 1.54 0 0 1-1.29-1.517z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span>Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('riwayatPiutang') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class="fill-white flex-shrink-0 w-6 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                        viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M755.2 938.666667H290.133333C224 938.666667 170.666667 885.333333 170.666667 819.2V204.8C170.666667 138.666667 224 85.333333 290.133333 85.333333h270.933334c10.666667 0 21.333333 4.266667 29.866666 12.8l270.933334 268.8c8.533333 8.533333 12.8 19.2 12.8 29.866667v422.4c0 66.133333-53.333333 119.466667-119.466667 119.466667zM290.133333 170.666667c-19.2 0-34.133333 14.933333-34.133333 34.133333v614.4c0 19.2 14.933333 34.133333 34.133333 34.133333h465.066667c19.2 0 34.133333-14.933333 34.133333-34.133333v-405.333333L544 170.666667H290.133333z" />
                                        <path
                                            d="M810.666667 448H554.666667c-23.466667 0-42.666667-19.2-42.666667-42.666667V149.333333c0-23.466667 19.2-42.666667 42.666667-42.666666s42.666667 19.2 42.666666 42.666666v213.333334h213.333334c23.466667 0 42.666667 19.2 42.666666 42.666666s-19.2 42.666667-42.666666 42.666667zM618.666667 682.666667H405.333333c-23.466667 0-42.666667-19.2-42.666666-42.666667s19.2-42.666667 42.666666-42.666667h213.333334c23.466667 0 42.666667 19.2 42.666666 42.666667s-19.2 42.666667-42.666666 42.666667z" />
                                        <path
                                            d="M512 789.333333c-23.466667 0-42.666667-19.2-42.666667-42.666666V533.333333c0-23.466667 19.2-42.666667 42.666667-42.666666s42.666667 19.2 42.666667 42.666666v213.333334c0 23.466667-19.2 42.666667-42.666667 42.666666z" />
                                    </svg>
                                    </div>
                                    <span>Piutang</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pembayaran-piutang.show') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class="w-6 h-6 flex-shrink-0 fill-white"viewBox="0 0 32 32"
                                            enable-background="new 0 0 32 32" id="Stock_cut" version="1.1"
                                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <desc />
                                                <g>
                                                    <path
                                                        d="M17,5H5 C3.895,5,3,5.895,3,7v22c0,1.105,0.895,2,2,2h18c1.105,0,2-0.895,2-2V18"
                                                        fill="none" stroke="#ffffff" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="2" />
                                                    <path d="M9,14H3v8h6 c2.209,0,4-1.791,4-4v0C13,15.791,11.209,14,9,14z"
                                                        fill="none" stroke="#ffffff" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="2" />
                                                    <circle cx="9" cy="18" r="1" />
                                                    <line fill="none" stroke="#ffffff" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="2" x1="25"
                                                        x2="25" y1="16" y2="1" />
                                                    <polyline fill="none" points="31,7 25,1 19,7 " stroke="#ffffff"
                                                        stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
                                                </g>
                                            </g>

                                        </svg>
                                    </div>
                                    <span>Pembayaran</span>
                                </div>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('detailpiutang.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class="fill-white flex-shrink-0 w-6 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 0C229.888 0 0 229.888 0 512s229.888 512 512 512 512-229.888 512-512S794.112 0 512 0z m442.368 512c0 243.712-198.144 442.368-442.368 442.368-243.712 0-442.368-198.144-442.368-442.368 0-243.712 198.144-442.368 442.368-442.368 243.712 0 442.368 198.656 442.368 442.368z" />
                                            <path
                                                d="M546.816 498.176V232.96c0-19.456-15.872-34.816-34.816-34.816-19.456 0-34.816 15.872-34.816 34.816v280.064c0 9.216 3.584 17.92 10.24 24.576l130.56 130.048c6.656 6.656 15.36 10.24 24.576 10.24 9.216 0 17.92-3.584 24.576-10.24 6.656-6.656 10.24-15.36 10.24-24.576 0-9.216-3.584-17.92-10.24-24.576l-120.32-120.32z" />
                                        </svg>
                                    </div>
                                    <span>Umur Piutang
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sp-bulanan') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class="fill-white flex-shrink-0 w-6 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                            viewBox="0 0 32 32" data-name="Layer 13" id="Layer_13">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">

                                                <title />

                                                <path
                                                    d="M28.55,6.57H26.42V4.93a0.5,0.5,0,1,0-1,0V6.57H19.81V5.06a0.5,0.5,0,0,0-1,0V6.57H13.19V5.06a0.5,0.5,0,0,0-1,0V6.57H6.58V5.06a0.5,0.5,0,1,0-1,0V6.57H3.45A2,2,0,0,0,1.5,8.52v17.1a2,2,0,0,0,1.95,2h25.1a2,2,0,0,0,1.95-2V8.52A2,2,0,0,0,28.55,6.57Zm-25.1,1H5.58V9.08a0.5,0.5,0,0,0,1,0V7.57h5.61V9.08a0.5,0.5,0,0,0,1,0V7.57h5.61V9.08a0.5,0.5,0,0,0,1,0V7.57h5.61V8.94a0.5,0.5,0,1,0,1,0V7.57h2.13a1,1,0,0,1,.95.95v2.94H2.5V8.52A1,1,0,0,1,3.45,7.57Zm25.1,19H3.45a1,1,0,0,1-.95-1V12.46h27V25.62A1,1,0,0,1,28.55,26.57Z" />
                                                <rect height="2.13" width="2.13" x="9.99" y="14.39" />
                                                <rect height="2.13" width="2.13" x="14.98" y="14.39" />
                                                <rect height="2.13" width="2.13" x="19.98" y="14.37" />
                                                <rect height="2.13" width="2.13" x="5" y="18.45" />
                                                <rect height="2.13" width="2.13" x="9.99" y="18.45" />
                                                <rect height="2.13" width="2.13" x="14.98" y="18.45" />
                                                <rect height="2.13" width="2.13" x="5" y="22.56" />
                                                <rect height="2.13" width="2.13" x="9.99" y="22.56" />
                                                <rect height="2.13" width="2.13" x="14.98" y="22.55" />
                                                <rect height="2.13" width="2.13" x="19.98" y="22.55" />
                                                <rect height="2.13" width="2.13" x="19.98" y="18.44" />
                                                <rect height="2.13" width="2.13" x="24.87" y="14.36" />
                                                <rect height="2.13" width="2.13" x="24.87" y="18.42" />
                                            </g>
                                        </svg>
                                    </div>
                                    <span>Schedule Piutang</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jatuh-tempo') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class=" fill-white w-6 h-6 flex-shrink-0" viewBox="0 0 1024 1024"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M810.666667 128h-178.56c-17.493333-49.493333-64.426667-85.333333-120.106667-85.333333s-102.613333 35.84-120.106667 85.333333H213.333333c-47.146667 0-85.333333 38.186667-85.333333 85.333333v597.333334c0 47.146667 38.186667 85.333333 85.333333 85.333333h597.333334c47.146667 0 85.333333-38.186667 85.333333-85.333333V213.333333c0-47.146667-38.186667-85.333333-85.333333-85.333333zM554.666667 768h-85.333334v-85.333333h85.333334v85.333333z m0-170.666667h-85.333334V341.333333h85.333334v256z m-42.666667-384c-23.466667 0-42.666667-18.986667-42.666667-42.666666s19.2-42.666667 42.666667-42.666667 42.666667 18.986667 42.666667 42.666667-19.2 42.666667-42.666667 42.666666z" />
                                        </svg>
                                    </div>
                                    <span>Jatuh Tempo</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pp-pengajuan') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg class="fill-white flex-shrink-0 w-6 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M736.2 590.9H274.5c-16.6 0-30 13.4-30 30s13.4 30 30 30h461.8c16.6 0 30-13.4 30-30s-13.5-30-30.1-30z" />
                                            <path d="M312.8 432.8m-61 0a61 61 0 1 0 122 0 61 61 0 1 0-122 0Z" />
                                            <path
                                                d="M815.3 155.3H206.6c-78 0-141.4 63.4-141.4 141.4v440.1c0 78 63.4 141.4 141.4 141.4h608.7c78 0 141.4-63.4 141.4-141.4V296.7c0.1-78-63.4-141.4-141.4-141.4z m81.9 581.5c0 45.2-36.7 81.9-81.9 81.9H206.6c-45.2 0-81.9-36.7-81.9-81.9V296.7c0-45.2 36.7-81.9 81.9-81.9h608.7c45.2 0 81.9 36.7 81.9 81.9v440.1z" />
                                        </svg>
                                    </div>
                                    <span>Pemutihan Piutang</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master_data_piutang') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg viewBox="0 0 1024 1024"
                                            class="flex-shrink-0 w-7 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                            version="1.1" class="arrow w-6 h-6 fill-white "
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M702.537143 218.477714c31.085714-10.825143 55.003429-23.113143 69.924571-35.328 10.24-8.338286 13.458286-13.824 13.458286-16.018285s-3.218286-7.68-13.458286-16.091429c-14.921143-12.141714-38.765714-24.429714-69.924571-35.254857C634.368 92.16 540.013714 78.336 438.857143 78.336s-195.510857 13.897143-263.68 37.449143c-31.085714 10.825143-55.003429 23.113143-69.924572 35.328-10.24 8.338286-13.458286 13.750857-13.458285 16.018286 0 2.194286 3.218286 7.68 13.458285 16.091428 14.921143 12.141714 38.765714 24.429714 69.924572 35.254857 68.169143 23.625143 162.523429 37.449143 263.68 37.449143s195.510857-13.897143 263.68-37.449143zM69.485714 464.749714v128.804572c37.961143 40.009143 140.068571 88.722286 264.777143 103.277714 182.857143 21.284571 355.986286-18.651429 473.526857-98.304l0.438857-131.657143C683.008 540.525714 506.733714 571.465143 328.484571 550.619429c-110.372571-12.8-204.361143-46.08-259.072-85.869715z m0-80.457143c38.034286 39.936 140.068571 88.649143 264.777143 103.131429 183.222857 21.357714 356.717714-18.724571 474.258286-98.742857l0.512-145.993143C734.208 286.573714 596.48 315.977143 438.857143 315.977143c-156.964571 0-294.253714-29.257143-369.152-72.777143A132116.333714 132116.333714 0 0 0 69.485714 384.219429z m0.146286 289.865143l0.292571 108.105143-1.097142-7.460571c22.381714 74.020571 165.302857 133.485714 378.148571 133.485714 115.931429 0 206.774857-17.554286 276.626286-52.077714 19.602286-9.728 34.523429-17.92 49.152-28.598857 9.728-7.094857 16.091429-11.410286 26.550857-20.626286 10.825143-9.581714 27.501714-7.241143 37.156571 3.657143 9.581714 10.752 10.825143 28.306286 0 37.961143-11.702857 10.24-17.188571 14.848-28.598857 23.186285-17.042286 12.434286-36.425143 25.380571-58.806857 36.498286-77.092571 38.107429-155.648 60.854857-302.08 60.854857-243.931429 0-405.211429-77.165714-436.077714-179.2l-1.097143-3.657143v-3.803428L9.362286 628.077714a116682.532571 116682.532571 0 0 1 0.365714-455.68 52.662857 52.662857 0 0 1-0.292571-5.266285C9.508571 84.918857 201.728 18.285714 438.857143 18.285714c237.129143 0 429.348571 66.633143 429.348571 148.845715a53.028571 53.028571 0 0 1-0.804571 9.581714 23.405714 23.405714 0 0 1 1.024 7.094857l-1.682286 520.411429c-0.073143 14.482286-13.385143 26.185143-29.769143 26.112-16.384 0-29.622857-11.776-29.549714-26.331429v-27.355429c-125.074286 73.216-301.056 104.082286-478.939429 83.382858-110.226286-12.873143-204.214857-46.08-258.925714-85.869715z m668.525714-290.962285a25.746286 25.746286 0 0 1-25.965714-25.453715c0-14.043429 11.702857-25.380571 26.038857-25.380571 14.336 0 26.038857 11.337143 26.038857 25.380571 0 14.116571-11.702857 25.453714-26.038857 25.453715z m0 209.408a25.746286 25.746286 0 0 1-25.965714-25.453715c0-14.043429 11.702857-25.453714 26.038857-25.453714 14.336 0 26.038857 11.410286 26.038857 25.453714 0 14.043429-11.702857 25.453714-26.038857 25.453715z m0 212.114285a25.746286 25.746286 0 0 1-25.965714-25.526857c0-14.043429 11.702857-25.453714 26.038857-25.453714 14.336 0 26.038857 11.410286 26.038857 25.453714 0 14.043429-11.702857 25.453714-26.038857 25.453714z"
                                                    fill="#fffafa" />
                                            </g>
                                        </svg>
                                    </div>
                                    <span>MD Piutang</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('masterDataPajak.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div
                                        class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg viewBox="0 0 1024 1024"
                                            class="flex-shrink-0 w-7 h-6 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
                                            version="1.1" class="arrow w-6 h-6 fill-white "
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M702.537143 218.477714c31.085714-10.825143 55.003429-23.113143 69.924571-35.328 10.24-8.338286 13.458286-13.824 13.458286-16.018285s-3.218286-7.68-13.458286-16.091429c-14.921143-12.141714-38.765714-24.429714-69.924571-35.254857C634.368 92.16 540.013714 78.336 438.857143 78.336s-195.510857 13.897143-263.68 37.449143c-31.085714 10.825143-55.003429 23.113143-69.924572 35.328-10.24 8.338286-13.458286 13.750857-13.458285 16.018286 0 2.194286 3.218286 7.68 13.458285 16.091428 14.921143 12.141714 38.765714 24.429714 69.924572 35.254857 68.169143 23.625143 162.523429 37.449143 263.68 37.449143s195.510857-13.897143 263.68-37.449143zM69.485714 464.749714v128.804572c37.961143 40.009143 140.068571 88.722286 264.777143 103.277714 182.857143 21.284571 355.986286-18.651429 473.526857-98.304l0.438857-131.657143C683.008 540.525714 506.733714 571.465143 328.484571 550.619429c-110.372571-12.8-204.361143-46.08-259.072-85.869715z m0-80.457143c38.034286 39.936 140.068571 88.649143 264.777143 103.131429 183.222857 21.357714 356.717714-18.724571 474.258286-98.742857l0.512-145.993143C734.208 286.573714 596.48 315.977143 438.857143 315.977143c-156.964571 0-294.253714-29.257143-369.152-72.777143A132116.333714 132116.333714 0 0 0 69.485714 384.219429z m0.146286 289.865143l0.292571 108.105143-1.097142-7.460571c22.381714 74.020571 165.302857 133.485714 378.148571 133.485714 115.931429 0 206.774857-17.554286 276.626286-52.077714 19.602286-9.728 34.523429-17.92 49.152-28.598857 9.728-7.094857 16.091429-11.410286 26.550857-20.626286 10.825143-9.581714 27.501714-7.241143 37.156571 3.657143 9.581714 10.752 10.825143 28.306286 0 37.961143-11.702857 10.24-17.188571 14.848-28.598857 23.186285-17.042286 12.434286-36.425143 25.380571-58.806857 36.498286-77.092571 38.107429-155.648 60.854857-302.08 60.854857-243.931429 0-405.211429-77.165714-436.077714-179.2l-1.097143-3.657143v-3.803428L9.362286 628.077714a116682.532571 116682.532571 0 0 1 0.365714-455.68 52.662857 52.662857 0 0 1-0.292571-5.266285C9.508571 84.918857 201.728 18.285714 438.857143 18.285714c237.129143 0 429.348571 66.633143 429.348571 148.845715a53.028571 53.028571 0 0 1-0.804571 9.581714 23.405714 23.405714 0 0 1 1.024 7.094857l-1.682286 520.411429c-0.073143 14.482286-13.385143 26.185143-29.769143 26.112-16.384 0-29.622857-11.776-29.549714-26.331429v-27.355429c-125.074286 73.216-301.056 104.082286-478.939429 83.382858-110.226286-12.873143-204.214857-46.08-258.925714-85.869715z m668.525714-290.962285a25.746286 25.746286 0 0 1-25.965714-25.453715c0-14.043429 11.702857-25.380571 26.038857-25.380571 14.336 0 26.038857 11.337143 26.038857 25.380571 0 14.116571-11.702857 25.453714-26.038857 25.453715z m0 209.408a25.746286 25.746286 0 0 1-25.965714-25.453715c0-14.043429 11.702857-25.453714 26.038857-25.453714 14.336 0 26.038857 11.410286 26.038857 25.453714 0 14.043429-11.702857 25.453714-26.038857 25.453715z m0 212.114285a25.746286 25.746286 0 0 1-25.965714-25.526857c0-14.043429 11.702857-25.453714 26.038857-25.453714 14.336 0 26.038857 11.410286 26.038857 25.453714 0 14.043429-11.702857 25.453714-26.038857 25.453714z"
                                                    fill="#fffafa" />
                                            </g>
                                        </svg>
                                    </div>
                                    <span>MD Pajak</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>

                <button
                    class="w-full hidden md:w-auto active:scale-[.95] hover:bg-white  transition-all text-white border-2 bg-red-700 hover:text-red-700 border-red-700 font-bold py-1 px-4 rounded-md shadow-sm mt-4">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
@endsection

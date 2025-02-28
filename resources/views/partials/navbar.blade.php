<link rel="stylesheet" href="custom.css">

<header id="navbar" class="fixed top-0 inset-x-0 z-10 transition-[top]">
    <nav
        class="bg-gray-300 border-gray-200 px-4  py-3 lg:px-14 md:px-12 gap-2 dark:bg-gray-800 w-full flex flex-row justify-evenly">
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
        {{-- <button id="menu-humburger" class="md:hidden  w-8  flex flex-col justify-center items-end gap-[3px] group">
            <span
                class="block w-full h-[3px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
            <span
                class="block w-[90%] h-[3px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
            <span
                class="block w-full h-[3px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
            <span
                class="block w-[90%] h-[3px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
        </button> --}}
    </nav>
	


</header>
<!-- Navigation Bar -->
<nav id="mobile-nav" class="flex items-center justify-between px-4 py-2 blur-10 backdrop-blur bg-white/30 shadow-md md:hidden fixed bottom-0 inset-x-0">
	<ul class="flex flex-row justify-between items-center space-x-6 w-full  ">
		<li class="">
			<!-- Hamburger Menu -->
			{{-- border-[2px] border-gray-700 --}}
			<button id="menu-humburger" class="md:hidden  w-8  flex flex-col justify-center items-center gap-[4px] group ">
				<span
					class="block w-[70%] h-[2px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
				<span
					class="block w-full h-[2px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
				<span
					class="block w-full h-[2px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
				<span
					class="block w-[70%] h-[2px] bg-gray-700 rounded transition-all duration-300 group-hover:bg-blue-600"></span>
			</button>
		</li>
		<li>
			<a href="{{ route('pembayaran-piutang.show') }}">
				<div class="w-[40px] flex justify-start items-center flex-col text-center text-xs/4">
					<div
						class="w-full rounded-sm py-1 px-2 bg-[#08a04a] text-white flex justify-center items-center">
						<svg class="w-6 h-4 flex-shrink-0 fill-white"viewBox="0 0 32 32"
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
			<a href="{{ route('riwayatPiutang') }}">
				<div class="w-[40px] flex justify-start items-center flex-col text-center text-xs/4">
					<div
						class="w-full rounded-sm py-1 px-2 bg-[#0a3c87] text-white flex justify-center items-center">
						<svg class="fill-white flex-shrink-0 w-6 h-4 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
						viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M755.2 938.666667H290.133333C224 938.666667 170.666667 885.333333 170.666667 819.2V204.8C170.666667 138.666667 224 85.333333 290.133333 85.333333h270.933334c10.666667 0 21.333333 4.266667 29.866666 12.8l270.933334 268.8c8.533333 8.533333 12.8 19.2 12.8 29.866667v422.4c0 66.133333-53.333333 119.466667-119.466667 119.466667zM290.133333 170.666667c-19.2 0-34.133333 14.933333-34.133333 34.133333v614.4c0 19.2 14.933333 34.133333 34.133333 34.133333h465.066667c19.2 0 34.133333-14.933333 34.133333-34.133333v-405.333333L544 170.666667H290.133333z" />
						<path
							d="M810.666667 448H554.666667c-23.466667 0-42.666667-19.2-42.666667-42.666667V149.333333c0-23.466667 19.2-42.666667 42.666667-42.666666s42.666667 19.2 42.666666 42.666666v213.333334h213.333334c23.466667 0 42.666667 19.2 42.666666 42.666666s-19.2 42.666667-42.666666 42.666667zM618.666667 682.666667H405.333333c-23.466667 0-42.666667-19.2-42.666666-42.666667s19.2-42.666667 42.666666-42.666667h213.333334c23.466667 0 42.666667 19.2 42.666666 42.666667s-19.2 42.666667-42.666666 42.666667z" />
						<path
							d="M512 789.333333c-23.466667 0-42.666667-19.2-42.666667-42.666666V533.333333c0-23.466667 19.2-42.666667 42.666667-42.666666s42.666667 19.2 42.666667 42.666666v213.333334c0 23.466667-19.2 42.666667-42.666667 42.666666z" />
					</svg>
					</div>
					<span>Riwayat </span>
				</div>
			</a>
		</li>
		<li>
			<a href="{{ route('detailpiutang.index') }}">
				<div class="w-[40px] flex justify-start items-center flex-col text-center text-xs/4">
					<div
						class="w-full rounded-sm py-1 px-2 bg-[#7b0c0c] text-white flex justify-center items-center">
						<svg class="fill-white flex-shrink-0 w-6 h-4 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
							viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M512 0C229.888 0 0 229.888 0 512s229.888 512 512 512 512-229.888 512-512S794.112 0 512 0z m442.368 512c0 243.712-198.144 442.368-442.368 442.368-243.712 0-442.368-198.144-442.368-442.368 0-243.712 198.144-442.368 442.368-442.368 243.712 0 442.368 198.656 442.368 442.368z" />
							<path
								d="M546.816 498.176V232.96c0-19.456-15.872-34.816-34.816-34.816-19.456 0-34.816 15.872-34.816 34.816v280.064c0 9.216 3.584 17.92 10.24 24.576l130.56 130.048c6.656 6.656 15.36 10.24 24.576 10.24 9.216 0 17.92-3.584 24.576-10.24 6.656-6.656 10.24-15.36 10.24-24.576 0-9.216-3.584-17.92-10.24-24.576l-120.32-120.32z" />
						</svg>
					</div>
					<span>Umur 
					</span>
				</div>
			</a>
		</li>
		<li>
			<a href="{{ route('sp-bulanan') }}">
				<div class="w-[40px] flex justify-start items-center flex-col text-center text-xs/4">
					<div
						class="w-full rounded-sm py-1 px-2 bg-[#d5e524e4] text-white flex justify-center items-center">
						<svg class="fill-white flex-shrink-0 w-6 h-4 text-white transition duration-75 group-hover:text-white dark:text-white dark:group-hover:text-white"
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
					<span>Schedule</span>
				</div>
			</a>
		</li>
	</ul>
</nav>
@push('scripts')
@vite('resources/js/navigasi.js')
@endpush

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">

    <!-- Add these new script imports -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.css">

    <!-- Your existing scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../../js/init-alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    
    <div class="flex h-screen w-full ">
        <!-- Sidebar -->
        <div class="md:flex flex-col w-64 bg-white mr-3">
            <div class="flex flex-col flex-1 overflow-y-auto scrollbar-hide">
                <nav class="flex flex-col flex-1 overflow-y-auto fixed px-2 py-2 gap-10">
                    <a class="ml-6 text-3xl font-bold" href="#">
                        <span class="text-orange-500 text-4xl">S</span><span class="text-gray-800">lice</span><span
                            class="text-orange-500 text-4xl">B</span><span class="text-gray-800">akery</span>
                    </a>
                    <div class="flex flex-col flex-1 gap-3">
                        <a href="/"
                            class="flex items-center px-4 py-2 mt-0 {{ request()->is('/') ? 'bg-purple-600 text-white' : 'text-black hover:bg-gray-400 hover:bg-opacity-25' }} rounded-2xl">
                            <svg class="h-5 w-5 {{ request()->is('/') ? 'text-white' : 'text-black-500' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="ml-2">Dashboard</span>
                        </a>
                        <a href="/produk"
                            class="flex items-center px-4 py-2 mt-2 {{ request()->is('produk*') ? 'bg-red-600 text-white' : 'text-black hover:bg-gray-400 hover:bg-opacity-25' }} rounded-2xl">
                            <svg class="h-5 w-5 {{ request()->is('produk*') ? 'text-white' : 'text-black-500' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="ml-2">Product</span>
                        </a>
                        <a href="/kategori"
                            class="flex items-center px-4 py-2 mt-2 {{ request()->is('kategori*') ? 'bg-red-600 text-white' : 'text-black hover:bg-gray-400 hover:bg-opacity-25' }} rounded-2xl">
                            <svg class="h-5 w-5 {{ request()->is('kategori*') ? 'text-white' : 'text-black-500' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="ml-2">Kategori</span>
                        </a>
                        <a href="/akun"
                            class="flex items-center px-4 py-2 mt-2 {{ request()->is('akun*') ? 'bg-blue-600 text-white' : 'text-black hover:bg-gray-400 hover:bg-opacity-25' }} rounded-2xl">
                            <svg class="h-5 w-5 {{ request()->is('akun*') ? 'text-white' : 'text-black-500' }}"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            <span class="ml-2">Pelanggan</span>
                        </a>
                        <a href="/pendapatan"
                            class="flex items-center px-4 py-2 mt-2 {{ request()->is('pendapatan*') ? 'bg-green-600 text-white' : 'text-black hover:bg-gray-400 hover:bg-opacity-25' }} rounded-2xl">
                            <svg class="h-5 w-5 {{ request()->is('pendapatan*') ? 'text-white' : 'text-black-500' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-2">Pendapatan</span>
                        </a>
                        
                        <span class="border-b"></span>
                        <a href=""
                            class="flex items-center px-4 py-2 mt-2 text-black hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <svg class="h-5 w-5 text-black-500" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <span class="ml-2">Pengaturan</span>
                        </a>
                        <a href="#"
                            class="logout-btn flex items-center px-4 py-2 mt-2 text-black hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="ml-2">Logout</span>
                        </a>
                        <form action="/logout" method="POST" id="logout-form" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full">
            <!-- Navbar -->
            <div class="flex items-center justify-between h-16 bg-white border-gray-200">
                <div class="flex flex-1 items-center space-x-4 mr-4 ">
                    <a href="#" class="text-black-600 hover:text-black-800 ml-auto">
                        <svg class="h-5 w-5 text-black-500" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                    </a>

                    <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start" class="object-cover mt-2 w-10 h-10 rounded-full cursor-pointer"
                        src="{{ asset('../../images/FOTOKU.jpg') }}" alt="User dropdown">

                    <div id="userDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div>Nanang Ardiansyah</div>
                            <div class="font-medium truncate">example@gmail.com</div>
                        </div>
                        <ul class="py-2 text-sm text-black " aria-labelledby="avatarButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 ">Profile</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="#"
                                class="logout-btn block px-4 py-2 text-sm text-black hover:bg-gray-100 ">Logout</a>
                        </div>
                        <form action="/logout" method="POST" id="logging-form">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>

            <!-- Dynamic Content Section -->
            @include('sweetalert::alert')
            @yield('content')


        </div>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.logout-btn').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7367f0',
                cancelButtonColor: '#82868b',
                confirmButtonText: 'Yes, Log Out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#logout-form').submit();
                }
            });
        });
    });
</script>
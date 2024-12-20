@extends('template.main')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="my-6 text-2xl font-semibold text-black">
            Dashboard
        </h2>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <!-- Card 1 - Total Barang -->
            <div class="bg-white rounded-lg shadow-md">
                <a href="/produk" class="flex items-center p-4">
                    <div class="p-3 mr-4 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-200">
                        <svg class="h-8 w-8 text-red-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21" />
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                            <line x1="12" y1="22.08" x2="12" y2="12" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-black">Total barang</p>
                        <p class="text-lg font-semibold text-black">{{ $jumlahBarang }}</p>
                    </div>
                </a>
            </div>

            <!-- Card 2 - Stok Barang -->
            <div class="bg-white rounded-lg shadow-md">
                <a href="/produk" class="flex items-center p-4">
                    <div class="p-3 mr-4 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-200">
                        <svg class="h-8 w-8 text-purple-700" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />
                            <rect x="9" y="3" width="6" height="4" rx="2" />
                            <line x1="9" y1="12" x2="9.01" y2="12" />
                            <line x1="13" y1="12" x2="15" y2="12" />
                            <line x1="9" y1="16" x2="9.01" y2="16" />
                            <line x1="13" y1="16" x2="15" y2="16" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-black">Stok Barang</p>
                        <p class="text-lg font-semibold text-black">{{ $totalStok }}</p>
                    </div>
                </a>
            </div>

            <!-- Card 3 - Pelanggan -->
            <div class="bg-white rounded-lg shadow-md">
                <a href="/akun" class="flex items-center p-4">
                    <div class="p-3 mr-4 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-200">
                        <svg class="h-8 w-8 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-black">Pelanggan</p>
                        <p class="text-lg font-semibold text-black">{{ $jumlahPelanggan }}</p>
                    </div>
                </a>
            </div>

            <!-- Card 4 - Uang Masuk -->
            <div class="bg-white rounded-lg shadow-md">
                <a href="/pendapatan" class="flex items-center p-4">
                    <div class="p-3 mr-4 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-200">
                        <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-black">Uang Masuk</p>
                        <p class="text-lg font-semibold text-black">Rp{{ number_format($jumlahPesanan, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Include Customer Table Component -->
        @include('customer.pelanggan')
    </div>
@endsection
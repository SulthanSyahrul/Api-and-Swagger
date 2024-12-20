<div class="container mx-auto">
    <h2 class="ml-0 my-6 text-2xl font-semibold text-gray-700 dark:text-black">
        Pendapatan Masuk
    </h2>
    <div class="mb-8 mr-4 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-black uppercase border-b-2 dark:border-gray-300 bg-purple-400 dark:text-white dark:bg-grey-500">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:bg-white">
                    @foreach ($pesanan as $item)
                    <tr class="text-gray-700 dark:text-black">
                        <!-- Nama -->
                        <td class="px-4 py-3 text-base">
                            {{ $item->nama }}
                        </td>
                        <!-- Tanggal (Hanya Tanggal) -->
                        <td class="px-4 py-3 text-base">
                            {{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}
                        </td>
                        <!-- Alamat (Alamat + Kecamatan + Kabupaten) -->
                        <td class="px-4 py-3 text-base">
                            {{ $item->alamat }}, {{ $item->kecamatan }}, {{ $item->kabupaten }}
                        </td>
                        <!-- Total Harga -->
                        <td class="px-4 py-3 text-base">
                            Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>
                        <!-- Action Tombol -->
                        <td class="pl-6">
                            <div class="flex items-center text-sm">
                                <a href="/showPelanggan/{{ $item->id }}"
                                    class="flex items-center justify-center px-2 py-2 text-sm font-medium leading-5 rounded-lg dark:text-red-800 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="View">
                                    <svg class="h-5 w-5 text-purple-700" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <circle cx="12" cy="12" r="2" />
                                        <path d="M2 12l1.5 2a11 11 0 0 0 17 0l1.5 -2" />
                                        <path d="M2 12l1.5 -2a11 11 0 0 1 17 0l1.5 2" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
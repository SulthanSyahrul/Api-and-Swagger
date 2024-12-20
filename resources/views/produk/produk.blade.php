@extends('template.main')

@section('content')
    <div class="container mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-black">
            CRUD Produk
        </h2>
        <div class="grid grid-cols-2">
            <div class="relative col-start-1">
                <input type="text" id="search" onkeyup="searchProduct()"
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-10 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="Search" />
                <button
                    class="absolute right-1 top-1 rounded bg-slate-800 p-1.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="col-end-7 mr-4 mb-2">
                <a href="/produk/create"
                    class="flex items-center bg-blue-500 hover:bg-blue-500 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-green-700 dark:hover:bg-green-700 dark:focus:bg-green-900">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2 text-sm text-white">Tambah Barang</span>
                </a>
            </div>
        </div>

        <div class="mb-8 mr-4 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto  overflow-y-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead class="sticky top-0 z-10 bg-gray-50">
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-black uppercase border-b-2 dark:border-gray-300 bg-red-400 dark:text-white dark:bg-grey-500">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Gambar</th>
                            <th class="px-4 py-3">Nama Produk</th>
                            <th class="px-4 py-3">Kategori Produk</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:bg-white">
                        @foreach ($produk as $data)
                            <tr class="text-gray-700 dark:text-black">
                                <td class="px-4 py-3 text-base">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">
                                    <img class="h-16 w-16 object-cover" src="/images/produk/{{ $data->image }}"
                                        alt="Gambar Produk" />
                                </td>
                                <td class="px-4 py-3 text-base">{{ $data->name }}</td>
                                <td class="px-4 py-3 text-base">{{ $data->category }}</td>
                                <td class="px-4 py-3 text-base">{{ $data->description }}</td>
                                <td class="px-4 py-3 text-base">{{ $data->stock }}</td>
                                <td class="px-4 py-3 text-base">Rp. {{ number_format($data->price, 0) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('produk.edit', $data->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-blue-800 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5 text-blue-700" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <!-- Tombol View -->
                                        <a href="{{ route('produk.show', $data->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg dark:text-red-800 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="View">
                                            <svg class="h-5 w-5 text-purple-700" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <circle cx="12" cy="12" r="2" />
                                                <path d="M2 12l1.5 2a11 11 0 0 0 17 0l1.5 -2" />
                                                <path d="M2 12l1.5 -2a11 11 0 0 1 17 0l1.5 2" />
                                            </svg>
                                        </a>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('produk.destroy', $data->id) }}" method="POST"
                                            onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-between px-2 mt-3 py-2 text-sm font-medium leading-5 rounded-lg dark:text-red-800 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete">
                                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endsection

    <script>
        function confirmDelete() {
            return confirm("Apakah kamu yakin ingin menghapus produk? jika dihapus maka produk tidak bisa dikembalikan lagi");
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('input', function () {
                const query = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(function (row) {
                    const nameCell = row.querySelector('td:nth-child(3)');
                    const name = nameCell ? nameCell.textContent.toLowerCase() : '';
                    
                    if (name.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
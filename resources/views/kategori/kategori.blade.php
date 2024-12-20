@extends('template.main')

@section('content')
    <div class="container mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-black">
            Kategori
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
                <a onclick="toggleAdd()"
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
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-black uppercase border-b-2 dark:border-gray-300 bg-yellow-200 dark:text-white dark:bg-grey-500">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Kategori</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:bg-white">
                        @foreach ($kategori as $data)
                            <tr class="text-gray-700 dark:text-black">
                                <td class="px-4 py-3 text-base">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 text-base">
                                    {{ $data->name }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <a onclick="toggleEdit({{ $data->id }}, '{{ $data->name }}')"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg dark:text-red-800 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5 text-blue-700" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('kategori.destroy', $data->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg dark:text-red-800 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete" onclick="return confirmDelete()">
                                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
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

        <!-- Modal Add -->
        <div id="cartOverlay" class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 z-10">
            <div class="fixed right-0 w-[640px] bg-white h-full shadow-xl z-20">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Tambah Kategori</h2>
                    <button onclick="toggleAdd()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <form class="mt-5 needs-validation" novalidate action="/kategori" method="POST">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    kategori</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nama Kategori" required="">
                            </div>

                        </div>
                        <button type="submit"
                            class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editOverlay" class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 z-10">
            <div class="fixed right-0 w-[640px] bg-white h-full shadow-xl z-20">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Edit Kategori</h2>
                    <button onclick="toggleEdit()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <form id="editForm" class="mt-5" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Nama kategori</label>
                                <input type="text" name="name" id="editName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukkan Nama Kategori" required>
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script setup lang="ts">
    function toggleAdd() {
        const cartOverlay = document.getElementById('cartOverlay');
        if (cartOverlay) {
            cartOverlay.classList.toggle('hidden');
        }
    }

    function toggleEdit(id = null, name = '') {
    const overlay = document.getElementById("editOverlay");
    const editForm = document.getElementById("editForm");
    const editNameInput = document.getElementById("editName");

    if (id) {
        // Update the form action to use the correct route
        editForm.action = `/kategori/${id}`;
        // Set the input value with the current name
        editNameInput.value = name;
        // Show the overlay
        overlay.classList.remove("hidden");
    } else {
        // Hide the overlay
        overlay.classList.add("hidden");
        // Reset the form action and input value
        editForm.action = "";
        editNameInput.value = "";
    }
}

    function confirmDelete() {
        return confirm(
            "Apakah kamu yakin ingin menghapus produk? jika dihapus maka produk tidak bisa dikembalikan lagi");
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(function(row) {
                const nameCell = row.querySelector('td:nth-child(2)');
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
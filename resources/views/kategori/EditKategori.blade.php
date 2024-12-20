@extends('template.main')

@section('content')

<!-- resources/views/components/edit-kategori.blade.php -->
<div id="editOverlay" class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 z-10">
    <div class="fixed right-0 w-[640px] bg-white h-full shadow-xl z-20">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Edit Kategori</h2>
            <button onclick="toggleEdit()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form class="mt-5 >
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama kategori</label>
                        <input type="text" name="name" id="editName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Masukkan Nama Kategori" required="">
                    </div>
                </div>
                <button type="submit"
                    class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection
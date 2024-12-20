@extends('template.main')

@section('content')
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4 text-center">Backup Sekarang</h1>

        @if(session('success'))
            <script>
                Swal.fire('Berhasil!', '{{ session("success") }}', 'success');
            </script>
        @elseif(session('error'))
            <script>
                Swal.fire('Gagal!', '{{ session("error") }}', 'error');
            </script>
        @endif

        <p class="text-gray-700 mb-4 text-center">
            Klik tombol di bawah ini untuk memulai backup data Anda.
        </p>

        <form action="{{ route('backup.now') }}" method="POST" class="text-center">
            @csrf
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Backup Now
            </button>
        </form>
    </div>

@endsection

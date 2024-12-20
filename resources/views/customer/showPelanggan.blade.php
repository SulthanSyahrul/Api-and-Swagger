@extends('template.main')

@section('content')
<div class="w-full mx-auto bg-white rounded-lg shadow-md p-6 overflow-y-auto max-h-[500px] mb-4">
    <div class="flex items-center mb-4">
        <span class="bg-green-100 text-green-700 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
            Paid
        </span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
        <div>
            <p class="text-left">
                <span class="font-semibold">Nama</span><br />
                {{ $pesanan->nama }}
            </p>
            <p class="mt-2 text-left">
                <span class="font-semibold">Tanggal Pesan</span><br />
                {{ \Carbon\Carbon::parse($pesanan->updated_at)->format('d/m/Y') }}
            </p>
            <p class="mt-2 text-left">
                <span class="font-semibold">Alamat</span><br />
                {{ $pesanan->alamat }}, {{ $pesanan->kecamatan }}, {{ $pesanan->kabupaten }}
            </p>
        </div>
        <div>
            <p class="mt-2 text-left">
                <span class="font-semibold">Catatan</span><br />
                {{ $pesanan->catatan ?? 'Tidak ada catatan.' }}
            </p>
        </div>
    </div>
    <div class="border-t border-gray-200 pt-4 mt-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
            <div>
                <p class="text-gray-800 text-lg font-semibold text-left">Total Bayar: 
                    <span class="text-black">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-200 mt-4 pt-4">
        @foreach ($keranjangItems as $item)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                <div class="flex items-start">
                    <img alt="{{ $item->produk->name }}" 
                        class="w-24 h-24 rounded-md object-cover mr-4"
                        src="/images/produk/{{ $item->produk->image}}" />
                    <div>
                        <p class="text-gray-800 font-semibold text-left">{{ $item->produk->name }}</p>
                        <p class="text-gray-600 text-left">Jumlah: {{ $item->quantity }}</p>
                    </div>
                </div>
                <p class="text-gray-800 font-semibold text-left">Rp{{ number_format($item->harga_total, 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

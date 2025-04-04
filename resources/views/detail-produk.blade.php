@extends('layouts.app')

@section('content')
    <!-- Konten Detail Produk -->
    <div class="container mx-auto px-20 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Gambar Produk -->
            <div>
                <img id="mainImage" src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                    class="w-full rounded-lg shadow-lg">

                <div class="grid grid-cols-4 gap-4 mt-4">
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                        class="w-full rounded cursor-pointer"
                        onclick="changeImage('{{ asset('storage/' . $produk->gambar) }}')">

                    {{-- @foreach($produk->gambar_lain as $gambar)
                    <img src="{{ asset('storage/' . $gambar) }}" alt="Detail {{ $loop->index + 1 }}"
                        class="w-full rounded cursor-pointer" onclick="changeImage('{{ asset('storage/' . $gambar) }}')">
                    @endforeach --}}
                </div>
            </div>

            <script>
                function changeImage(src) {
                    document.getElementById('mainImage').src = src;
                }
            </script>

            <!-- Informasi Produk -->
            <div class="space-y-6">
                <h1 class="text-3xl font-bold">{{ $produk->nama }}</h1>
                <div class="flex items-center space-x-2">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-gray-600 ml-2">4.8 (120 ulasan)</span>
                    </div>
                </div>
                <p class="text-3xl font-bold text-blue-600">Rp
                    {{ number_format($produk->harga, 0, ',', '.') }}/{{ $produk->satuan }}</p>

                <div class="border-t border-b py-4">
                    <h3 class="font-semibold mb-2">Spesifikasi:</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Diameter: {{ $produk->diameter }} mm</li>
                        <li>• Panjang: {{ $produk->panjang }} meter</li>
                        <li>• Grade: {{ $produk->grade }}</li>
                        <li>• Berat per batang: {{ $produk->berat }} kg</li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <label class="font-semibold">Jumlah:</label>
                        <div class="flex items-center">
                            <button class="bg-gray-200 px-3 py-1 rounded-l">-</button>
                            <input type="number" value="1" class="w-16 text-center border-y px-2 py-1">
                            <button class="bg-gray-200 px-3 py-1 rounded-r">+</button>
                        </div>
                        <span class="text-gray-500">Stok: {{ $produk->stok }} batang</span>
                    </div>
                    <div class="flex space-x-4">
                        <!-- Tombol Tambah ke Keranjang -->
                        <form action="{{ route('cart.add', $produk->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600">
                                Tambah ke Keranjang
                            </button>
                        </form>

                        <!-- Tombol Beli Sekarang -->
                        <form action="{{ route('cart.add', $produk->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit"
                                class="w-full border border-blue-500 text-blue-500 py-3 rounded-lg hover:bg-blue-50">
                                Beli Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Produk -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Deskripsi Produk</h2>
            <div class="prose max-w-none text-gray-600">
                {!! nl2br(e($produk->deskripsi)) !!}
            </div>
        </div>
    </div>
@endsection
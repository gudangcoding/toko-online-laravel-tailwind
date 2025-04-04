@extends('layouts.app')
@section('content')
    <!-- Konten Produk -->
    <section class="py-16">
        <div class="container mx-auto px-20">
            <h1 class="text-4xl font-bold text-center mb-12">Produk Kami</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Produk 1 -->
                @foreach ($produks as $produk)

             
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="img/produk1.jpg" alt="Besi Beton" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div>
                            <h3 class="text-xl font-semibold mb-2">{{ $produk->nama }}</h3>
                            <p class="text-blue-600 font-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $produk->deskripsi }}.</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('produk.detail', $produk->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Lihat Detail
                            </a>
                            <a href="{{ route('produk.detail', $produk->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Order
                            </a >
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
            <div class="mt-8">
                {{ $produks->links() }}
            </div>
        </div>
    </section>
@endsection

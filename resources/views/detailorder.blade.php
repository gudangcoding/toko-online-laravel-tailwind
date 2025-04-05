@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-20 py-16">
        <div class="flex gap-8">
            <!-- Menu Kiri -->
            <div class="w-1/4">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="space-y-4">
                        <a href="#" class="block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Dashboard
                        </a>
                        <a href="{{ route('order.index') }}" class="block text-gray-700 px-4 py-2 rounded hover:bg-gray-100">
                            Pesanan Saya
                        </a>
                        <a href="{{ route('pelanggan.profil', Auth::user()->id) }}"
                            class="block text-gray-700 px-4 py-2 rounded hover:bg-gray-100">
                            Profil
                        </a>
                        <a href="{{ route('pelanggan.gantipass', Auth::user()->id) }}"
                            class="block text-gray-700 px-4 py-2 rounded hover:bg-gray-100">
                            Ganti Password
                        </a>
                        <a href="{{ route('pelanggan.logout') }}"
                            class="block text-red-500 px-4 py-2 rounded hover:bg-red-50">
                            Keluar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Konten Kanan -->
            <div class="w-3/4">
                <div class="bg-white shadow-lg rounded-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">Detail Pesanan #ORD{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
                    </h2>

                    <!-- Informasi Umum Pesanan -->
                    <div class="mb-6">
                        <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y') }}</p>
                        <p>
                            <strong>Status Pembayaran:</strong>
                            <span
                                class="{{ $order->status_pembayaran == 'dibayar' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ ucfirst($order->status_pembayaran) }}
                            </span>
                        </p>
                        <p class="mt-2">
                            <strong>Status Order:</strong>
                            <span class="px-2 py-1 rounded text-white text-sm 
                                {{ $order->status == 'selesai' ? 'bg-green-600' : 
                                   ($order->status == 'diproses' ? 'bg-blue-500' : 
                                   ($order->status == 'dikirim' ? 'bg-indigo-500' : 'bg-gray-500')) }}">
                              {{ ucfirst($order->status) }}
                            </span>
                          </p>
                        <p><strong>Alamat Pengiriman:</strong> {{ $order->user->alamat }}</p>
                    </div>

                    <!-- Daftar Produk -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left">Produk</th>
                                    <th class="px-4 py-2 text-left">Jumlah</th>
                                    <th class="px-4 py-2 text-left">Harga</th>
                                    <th class="px-4 py-2 text-left">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetail as $detail)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $detail->produk->nama }}</td>
                                        <td class="px-4 py-2">{{ $detail->jumlah }}</td>
                                        <td class="px-4 py-2">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-right font-semibold">Total:</td>
                                    <td class="px-4 py-2 font-bold text-red-600">Rp
                                        {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('order.index') }}" class="text-blue-500 hover:underline">&larr; Kembali ke daftar
                            pesanan</a>
                    </div>
                    <!-- Tombol Pembayaran -->
                    @if ($order->status_pembayaran == 'pending')
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('midtrans.bayar', ['order_id' => $order->id]) }}"
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                                Bayar Sekarang
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

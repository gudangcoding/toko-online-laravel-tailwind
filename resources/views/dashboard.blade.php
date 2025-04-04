@extends('layouts.app')
@section('content')
  <!-- Konten Dashboard -->
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
                    <a href="{{ route('pelanggan.profil', Auth::user()->id) }}" class="block text-gray-700 px-4 py-2 rounded hover:bg-gray-100">
                        Profil
                    </a>
                    <a href="{{ route('pelanggan.gantipass', Auth::user()->id) }}" class="block text-gray-700 px-4 py-2 rounded hover:bg-gray-100">
                        Ganti Password
                    </a>
                    <a href="{{ route('pelanggan.logout') }}" class="block text-red-500 px-4 py-2 rounded hover:bg-red-50">
                        Keluar
                    </a>
                </div>
            </div>
        </div>

        <!-- Konten Kanan -->
        <div class="w-3/4">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

                <!-- Ringkasan -->
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Total Pesanan</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $orders->count() }}</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Pesanan Selesai</h3>
                        <p class="text-3xl font-bold text-green-600">
                            {{ $orders->where('status', 'selesai')->count() }}
                        </p>
                    </div>
                    <div class="bg-yellow-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Pesanan Proses</h3>
                        <p class="text-3xl font-bold text-yellow-600">
                            {{ $orders->where('status', 'proses')->count() }}
                        </p>
                    </div>
                </div>

                <!-- Pesanan Terbaru -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Pesanan Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($orders->take(5) as $order)
                                <tr>
                                    <td class="px-6 py-4">#ORD{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if($order->status == 'selesai') bg-green-100 text-green-800
                                            @elseif($order->status == 'proses') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-2">
                                        <a href="{{ route('order.detail', $order->id) }}"   class="bg-orange-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                            Lihat Detail                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

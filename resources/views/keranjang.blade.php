@extends('layouts.app')

@section('content')
<div class="container mx-auto px-20 py-16">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar Produk -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8" id="cart-container">
        @forelse ($cart as $id => $item)
        <div class="cart-item flex items-center justify-between border-b pb-4 mb-4" data-id="{{ $id }}">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama_produk'] }}" class="w-24 h-24 object-cover rounded">
                <div>
                    <h3 class="font-semibold">{{ $item['nama_produk'] }}</h3>
                    <p class="text-gray-600">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2">
                        <button class="bg-gray-200 px-3 py-1 rounded btn-decrease">-</button>
                        <input type="number" value="{{ $item['jumlah'] }}" min="1" class="w-16 text-center mx-2 border rounded jumlah-input" readonly>
                        <button class="bg-gray-200 px-3 py-1 rounded btn-increase">+</button>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <p class="font-semibold subtotal">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</p>
                <button class="text-red-500 mt-2 btn-remove">Hapus</button>
            </div>
        </div>
        @empty
        <p>Keranjang kosong.</p>
        @endforelse
    </div>

    <!-- Ringkasan Belanja -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Ringkasan Belanja</h2>
        <div class="space-y-2 mb-4">
            <div class="flex justify-between">
                <p>Total Harga (<span id="total-items">{{ count($cart) }}</span> barang)</p>
                <p id="total-harga">Rp {{ number_format(collect($cart)->sum(fn($item) => $item['harga'] * $item['jumlah']), 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p>Biaya Pengiriman</p>
                <p>Rp 0</p>
            </div>
            <div class="border-t pt-2 mt-2">
                <div class="flex justify-between font-semibold">
                    <p>Total Tagihan</p>
                    <p id="total-tagihan">Rp {{ number_format(collect($cart)->sum(fn($item) => $item['harga'] * $item['jumlah']), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 text-center">
                Lanjut ke Pembayaran
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartContainer = document.getElementById('cart-container');

    function updateSummary() {
        let totalItems = 0;
        let totalHarga = 0;

        document.querySelectorAll('.cart-item').forEach(item => {
            const jumlah = parseInt(item.querySelector('.jumlah-input').value);
            const harga = parseInt(item.querySelector('.subtotal').dataset.harga);
            totalItems += jumlah;
            totalHarga += harga;
        });

        document.getElementById('total-items').innerText = totalItems;
        document.getElementById('total-harga').innerText = formatRupiah(totalHarga);
        document.getElementById('total-tagihan').innerText = formatRupiah(totalHarga);
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    cartContainer.addEventListener('click', function (e) {
        const btn = e.target;
        const item = btn.closest('.cart-item');
        const id = item.dataset.id;
        const input = item.querySelector('.jumlah-input');
        let jumlah = parseInt(input.value);
        let hargaSatuan = parseInt(item.querySelector('.subtotal').dataset.harga) / jumlah;

        if (btn.classList.contains('btn-increase')) {
            jumlah++;
        } else if (btn.classList.contains('btn-decrease')) {
            if (jumlah > 1) jumlah--;
        } else if (btn.classList.contains('btn-remove')) {
            fetch(`/cart/hapus/${id}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(() => {
                    item.remove();
                    updateSummary();
                });
            return;
        }

        fetch(`/cart/update/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ jumlah: jumlah })
        }).then(() => {
            input.value = jumlah;
            const subtotal = hargaSatuan * jumlah;
            item.querySelector('.subtotal').innerText = formatRupiah(subtotal);
            item.querySelector('.subtotal').dataset.harga = subtotal;
            updateSummary();
        });
    });

    // Set initial subtotal data
    document.querySelectorAll('.cart-item').forEach(item => {
        const jumlah = parseInt(item.querySelector('.jumlah-input').value);
        const hargaText = item.querySelector('.subtotal').innerText.replace(/\D/g, '');
        const harga = parseInt(hargaText) || 0;
        item.querySelector('.subtotal').dataset.harga = harga;
    });

});
</script>
@endsection

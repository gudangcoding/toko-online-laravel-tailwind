@extends('layouts.app')
@section('content')
  <!-- Konten Detail Blog -->
  <div class="container mx-auto px-20 py-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-6">Tips Memilih Besi Beton Berkualitas untuk Konstruksi</h1>
        
        <div class="flex items-center text-gray-600 mb-8">
            <span class="mr-4">12 Maret 2024</span>
            <span>Oleh: Tim Teknis PT Baja Makmur</span>
        </div>

        <img src="img/blog-detail.jpg" alt="Tips Memilih Besi" class="w-full h-96 object-cover rounded-lg mb-8">

        <div class="prose max-w-none">
            <p class="text-gray-700 mb-6">
                Memilih besi beton yang tepat merupakan langkah krusial dalam memastikan kekuatan dan ketahanan struktur bangunan. Artikel ini akan membahas beberapa tips penting dalam memilih besi beton berkualitas untuk proyek konstruksi Anda.
            </p>

            <h2 class="text-2xl font-semibold mb-4">1. Perhatikan Standar Kualitas</h2>
            <p class="text-gray-700 mb-6">
                Pastikan besi beton yang Anda pilih memenuhi standar SNI (Standar Nasional Indonesia). Standar ini mencakup berbagai aspek seperti kekuatan tarik, kelenturan, dan komposisi material.
            </p>

            <h2 class="text-2xl font-semibold mb-4">2. Periksa Spesifikasi Teknis</h2>
            <p class="text-gray-700 mb-6">
                Setiap proyek konstruksi memiliki kebutuhan spesifik. Perhatikan diameter, panjang, dan grade besi beton yang sesuai dengan kebutuhan proyek Anda.
            </p>

            <h2 class="text-2xl font-semibold mb-4">3. Pilih Supplier Terpercaya</h2>
            <p class="text-gray-700 mb-6">
                Bekerja sama dengan supplier berpengalaman dan terpercaya akan memastikan Anda mendapatkan produk berkualitas dengan pelayanan yang profesional.
            </p>
        </div>

        <!-- Bagian Share -->
        <div class="border-t border-gray-200 mt-12 pt-8">
            <h3 class="text-xl font-semibold mb-4">Bagikan Artikel Ini</h3>
            <div class="flex space-x-4">
                <a href="#" class="text-blue-600 hover:text-blue-800">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="#" class="text-blue-400 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
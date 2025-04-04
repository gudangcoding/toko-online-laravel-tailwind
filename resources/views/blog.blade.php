@extends('layouts.app')
@section('content')
 <!-- Konten Blog -->
 <div class="container mx-auto px-20 py-16">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">Blog & Artikel</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Artikel 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="img/blog1.jpg" alt="Tips Konstruksi" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Tips Memilih Besi Beton Berkualitas</h3>
                <p class="text-gray-600 mb-4">Panduan lengkap memilih besi beton yang tepat untuk proyek konstruksi Anda.</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">12 Maret 2024</span>
                    <a href="blog-detail.html" class="text-blue-500 hover:text-blue-600">Baca Selengkapnya</a>
                </div>
            </div>
        </div>

        <!-- Artikel 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="img/blog2.jpg" alt="Inovasi Konstruksi" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Inovasi Terbaru dalam Industri Baja</h3>
                <p class="text-gray-600 mb-4">Perkembangan teknologi terkini dalam industri baja dan pengaruhnya.</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">10 Maret 2024</span>
                    <a href="#" class="text-blue-500 hover:text-blue-600">Baca Selengkapnya</a>
                </div>
            </div>
        </div>

        <!-- Artikel 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="img/blog3.jpg" alt="Panduan Perawatan" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Panduan Perawatan Struktur Baja</h3>
                <p class="text-gray-600 mb-4">Tips dan trik merawat struktur baja agar tahan lama dan tetap kokoh.</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">8 Maret 2024</span>
                    <a href="#" class="text-blue-500 hover:text-blue-600">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
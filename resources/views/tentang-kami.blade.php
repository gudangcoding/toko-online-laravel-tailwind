@extends('layouts.app')
@section('content')
<!-- Konten Tentang Kami -->
<section class="py-16">
    <div class="container mx-auto px-20">
        <h1 class="text-4xl font-bold text-center mb-12">Tentang PT Baja Makmur</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <img src="img/about.jpg" alt="Tentang Kami" class="rounded-lg shadow-lg">
            </div>
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold">Sejarah Kami</h2>
                <p class="text-gray-600">
                    PT Baja Makmur didirikan pada tahun 2000 sebagai perusahaan supplier besi dan baja terpercaya di Indonesia. Selama lebih dari 20 tahun, kami telah melayani berbagai proyek konstruksi besar dan kecil dengan komitmen untuk memberikan produk berkualitas tinggi dan layanan terbaik.
                </p>
                <p class="text-gray-600">
                    Dengan pengalaman yang luas dan jaringan supplier yang kuat, kami menjadi mitra terpercaya dalam menyediakan material baja untuk berbagai kebutuhan industri dan konstruksi.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <div class="text-4xl font-bold text-blue-500 mb-2">20+</div>
                <p class="text-gray-600">Tahun Pengalaman</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <div class="text-4xl font-bold text-blue-500 mb-2">1000+</div>
                <p class="text-gray-600">Proyek Selesai</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <div class="text-4xl font-bold text-blue-500 mb-2">500+</div>
                <p class="text-gray-600">Pelanggan Puas</p>
            </div>
        </div>

        <div class="space-y-8">
            <h2 class="text-2xl font-semibold text-center">Visi & Misi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Visi</h3>
                    <p class="text-gray-600">
                        Menjadi perusahaan supplier baja terdepan di Indonesia yang dikenal akan kualitas produk dan layanan prima kepada pelanggan.
                    </p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Misi</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Menyediakan produk baja berkualitas tinggi</li>
                        <li>• Memberikan pelayanan terbaik dan solusi tepat</li>
                        <li>• Mengutamakan kepuasan pelanggan</li>
                        <li>• Mengembangkan SDM yang profesional</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
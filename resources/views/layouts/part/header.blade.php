<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
   <nav id="nav" class="bg-white shadow-lg">
    <div class="container mx-auto flex items-center justify-between py-5 px-20">
      <a href="/"> <img src="img/logo.png" alt="logo perusahaan" class="w-32"></a>
        <div class="hidden md:flex space-x-8">
            <a href="/" class="text-gray-700 hover:text-blue-500">Beranda</a>
            <a href="{{ route('tentang.index') }}" class="text-gray-700 hover:text-blue-500">Tentang Kami</a>
            <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-blue-500">Blog</a>
            <a href="{{ route('produk.index') }}" class="text-gray-700 hover:text-blue-500">Produk</a>
            <a href="{{ route('kontak.index') }}" class="text-gray-700 hover:text-blue-500">Kontak</a>
            <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-500">Cart</a>
            @auth
            <a href="{{ route('pelanggan.index') }}" class="text-gray-700 hover:text-blue-500">Akun</a>
            @endauth
        </div>
        <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Hubungi Kami
        </button>
    </div>
   </nav>
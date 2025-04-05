@extends('layouts.app')
@section('content')
 <!-- Konten Blog -->
 <div class="container mx-auto px-20 py-16">
    <h1 class="text-4xl font-bold text-gray-800 mb-12">Blog & Artikel</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Artikel 1 -->
        @foreach ($blog as $b)
            
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $b->gambar) }}" alt="Tips Konstruksi" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $b->judul }}</h3>
                <p class="text-gray-600 mb-4">{{$b->konten}}</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">{{ $b->created_at }}</span>
                    <a href="{{ route('blog.detail',$b->id) }}" class="text-blue-500 hover:text-blue-600">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach

       
    </div>
</div>
@endsection
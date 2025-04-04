@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-semibold mb-4">Ganti Password</h1>

    {{-- Tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tampilkan pesan error --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.updatePassword') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password Lama</label>
            <input type="password" name="old_password" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password Baru</label>
            <input type="password" name="new_password" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

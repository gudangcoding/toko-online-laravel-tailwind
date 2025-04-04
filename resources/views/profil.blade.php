@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-semibold mb-4">Update Profil</h1>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
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

    <form action="{{ route('profil.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">No. HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                   class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Alamat</label>
            <textarea name="alamat" class="w-full p-2 border rounded" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

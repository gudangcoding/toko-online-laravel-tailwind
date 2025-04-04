@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Tab Headers -->
                <div class="flex">
                    <button
                        class="w-1/3 px-4 py-3 text-sm font-medium text-center text-white bg-blue-500 border-b-2 border-blue-500"
                        id="loginTab">
                        Masuk
                    </button>
                    <button
                        class="w-1/3 px-4 py-3 text-sm font-medium text-center text-gray-600 bg-gray-50 hover:bg-gray-100"
                        id="registerTab">
                        Daftar
                    </button>
                    <button
                        class="w-1/3 px-4 py-3 text-sm font-medium text-center text-gray-600 bg-gray-50 hover:bg-gray-100"
                        id="resetTab">
                        Reset Password
                    </button>
                </div>

                <!-- Login Form -->
                <div id="loginForm" class="p-6">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('pelanggan.login') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" class="h-4 w-4 text-blue-500">
                                <label class="ml-2 text-sm text-gray-600">Ingat saya</label>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Masuk</button>
                    </form>
                </div>

                <!-- Register Form -->
                <div id="registerForm" class="p-6 hidden">
                    <form action="{{ route('pelanggan.daftar') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">NO Hp</label>
                            <input type="no_hp" name="no_hp"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                            <input type="alamat" name="alamat"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                value="{{ old('alamat') }}" required>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required>
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Daftar</button>
                    </form>
                </div>

                <!-- Reset Password Form -->
                <div id="resetForm" class="p-6 hidden">
                    
                    <form action="{{ route('pelanggan.reqpass') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Kirim Link Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const resetTab = document.getElementById('resetTab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const resetForm = document.getElementById('resetForm');

        loginTab.addEventListener('click', () => {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            resetForm.classList.add('hidden');
        });

        registerTab.addEventListener('click', () => {
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            resetForm.classList.add('hidden');
        });

        resetTab.addEventListener('click', () => {
            resetForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            registerForm.classList.add('hidden');
        });
    </script>
@endsection

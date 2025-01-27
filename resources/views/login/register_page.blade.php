@extends('layouts.app')

@section('title', 'Register Page')

@section('content')
    @php
        $class_input =
            'border border-slate-500 rounded-md px-4 py-2 outline-none focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 w-full';
        $class_label = 'text-lg text-slate-900 font-semibold';
    @endphp
    <div class="flex items-center justify-center h-screen my-16">
        <form action="{{route('register.submit')}}" method="POST"
            class="border border-slate-500 bg-blue-800 bg-opacity-65 shadow-2xl shadow-neutral-900 w-96 md:w-auto h-auto flex flex-col md:flex-row font-[Poppins] items-center md:items-start justify-center py-8 rounded-xl">
            @csrf

            <div class="hidden md:flex flex-col w-70 justify-center items-center">
                <img src="resources/login/9796597.jpg" alt="" class="rounded-3xl w-40 h-40 mx-auto mt-36">
                <h1 class="text-center text-2xl font-semibold text-slate-800 mt-10 mx-8">Perpustakaan Digital</h1>
            </div>
            <img src="resources/login/9796597.jpg" alt="" class="rounded-full w-32 h-32 mx-auto md:hidden">
            <div class="md:border-l-2">
                <div class="md:mx-2">
                    <h1 class="text-center text-2xl font-semibold mt-2">Halo, Selamat Datang!</h1>
                    <p class="text-center text-lg mt-2">Silakan buat akun Anda</p>
                    <div class="mx-4 flex flex-col gap-y-2 mt-4">
                        <div>
                            <label for="nama_lengkap" class="{{ $class_label }}">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan nama lengkap"
                                class="{{ $class_input }}" required>

                                @error('nama_lengkap')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                        </div>

                        <div>
                            <label for="email" class="{{ $class_label }}">Alamat Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukan alamat email"
                                class="{{ $class_input }}">

                                @error('email')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                        </div>
                        <div>
                            <label for="username" class="{{ $class_label }}">Username</label>
                            <input type="text" name="username" id="username" placeholder="Masukan username"
                                class="{{ $class_input }}">
                                @error('username')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                        </div>

                        <div>
                            <label for="password" class="{{ $class_label }}">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukan password"
                                class="{{ $class_input }}">
                                @error('password')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                        </div>

                        <div>
                            <label for="alamat" class="{{ $class_label }}">Alamat</label>
                            <textarea type="text" name="alamat" id="alamat" placeholder="Masukan alamat"
                                class="{{ $class_input }}"></textarea>
                                @error('alamat')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                        </div>

                        <p class="text-sm">Sudah punya akun? <a href="{{route('login')}}" class="underline text-emerald-900">Masuk</a>
                        </p>

                        <button
                            class="bg-emerald-700 hover:bg-emerald-900 hover:text-white duration-150 text-slate-200 px-4 py-2 rounded-md mt-4">
                            Daftar
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

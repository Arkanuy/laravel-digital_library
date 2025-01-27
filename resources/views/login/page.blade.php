@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    @php
        $class_input =
            'border border-slate-500 rounded-md px-4 py-2 outline-none focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 w-full';
        $class_label = 'text-lg text-slate-900 font-semibold';
    @endphp
    <div class="flex items-center justify-center h-screen">
        <form action="{{route('login.submit')}}" method="POST"
            class="border border-slate-500 bg-blue-800 bg-opacity-65 shadow-2xl shadow-neutral-900 w-80 md:w-auto h-auto flex flex-col md:flex-row font-[Poppins] items-center md:items-start justify-center py-8 rounded-xl">

            @csrf

            <img src="resources/login/9796597.jpg" alt="" class="rounded-full w-32 h-32 mx-auto md:hidden">
            <div class="md:border-r-2">
                <div class="md:mx-2">
                    <h1 class="text-center text-2xl font-semibold mt-2">Halo, Selamat Datang!</h1>
                    <p class="text-center text-lg mt-2">Silakan login ke akun Anda</p>
                    <div class="mx-4 flex flex-col gap-y-2 mt-4">
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

                        <p class="text-sm">Belum punya akun? <a href="{{route('register')}}" class="underline text-emerald-900">Daftar</a>
                        </p>

                        <button
                            class="bg-emerald-700 hover:bg-emerald-900 hover:text-white duration-150 text-slate-200 px-4 py-2 rounded-md mt-4">
                            Masuk
                        </button>
                    </div>
                </div>
            </div>

            <div class="hidden md:flex flex-col w-64 ">
                <img src="resources/login/9796597.jpg" alt="" class="rounded-3xl w-40 h-40 mx-auto mt-8">
                <h1 class="text-center text-2xl font-semibold text-slate-800 mt-10">Perpustakaan Digital</h1>
            </div>
        </form>
    </div>
@endsection

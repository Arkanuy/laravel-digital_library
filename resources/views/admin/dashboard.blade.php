@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
    <x-layouts.admin.sidebar />
@endsection

@section('content')
    <div class="flex flex-col  mx-4 my-4  gap-2">

        <div class="flex flex-row  gap-2">

            <div class="bg-white p-4 rounded-lg shadow-xl flex flex-col gap-6">
                <h1>Total User</h1>
                <p>{{ $user_count }}</p>
            </div>

            <div class="bg-white  p-4 rounded-lg shadow-xl flex flex-col gap-6">
                <h1>Total Admin</h1>
                <p>{{ $admin_count }}</p>
            </div>

            <div class="bg-white  p-4 rounded-lg shadow-xl flex flex-col gap-6">
                <h1>Total Buku</h1>
                <p>{{ $total_buku }}</p>
            </div>
            <div class="bg-white  p-4 rounded-lg shadow-xl flex flex-col gap-6">
                <h1>Total Peminjaman</h1>
                <p>{{ $total_peminjaman }}</p>
            </div>
        </div>

        <div class="flex flex-row  gap-2">


            <div class="bg-white  p-4 rounded-lg shadow-xl flex flex-col gap-6">
                <h1>Total Peminjaman Yang sudah di kembalikan</h1>
                <p>{{ $sudah_dikembalikan }}</p>
            </div>
            <div class="bg-white  p-4 rounded-lg shadow-xl flex flex-col gap-6">
                <h1>Total Peminjaman Yang belum di kembalikan</h1>
                <p>{{ $belum_dikembalikan }}</p>
            </div>
        </div>
    </div>



@endsection

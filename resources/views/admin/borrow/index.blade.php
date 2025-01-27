@extends('layouts.app')

@section('title', 'Peminjaman')

@section('sidebar')
    <x-layouts.admin.sidebar />
@endsection

@section('content')
    @php
        $class_table = 'border border-slate-400';

        $class_table_head = 'text-start px-2 border-l border-slate-400';
        $class_table_data = 'text-start px-2 border-l border-slate-400';

        $class_input =
            'border border-slate-500 rounded-md px-4 py-2 outline-none focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 w-full';
        $class_label = 'text-lg text-slate-900 font-semibold';

    @endphp
    <div class="bg-white mx-4 my-4 p-4 rounded-lg shadow-xl flex flex-row gap-6">
        <div class="w-full">
            <h1 class="text-xl font-semibold text-slate-800">Daftar Peminjaman</h1>

            <table class="{{ $class_table }} w-full">
                <tr class="border border-slate-400 w-full">
                    <th class="{{ $class_table_head }}">Id</th>
                    <th class="{{ $class_table_head }}">Nama Peminjam</th>
                    <th class="{{ $class_table_head }}">Judul Buku</th>
                    <th class="{{ $class_table_head }}">Tanggal Peminjaman</th>
                    <th class="{{ $class_table_head }}">Tanggal Pengembalian</th>
                    <th class="{{ $class_table_head }}">Status</th>
                </tr>
                @foreach ($peminjaman as $item)
                    <tr>
                        <td class="{{$class_table_data}}">{{$item->id}}</td>
                        <td class="{{$class_table_data}}">{{$item->user->nama_lengkap}}</td>
                        <td class="{{$class_table_data}}">{{$item->buku->judul}}</td>
                        <td class="{{$class_table_data}}">{{$item->tangal_peminjaman}}</td>
                        <td class="{{$class_table_data}}">{{$item->tanggal_pengembalian == null ? '...' : $item->tanggal_pengembalian}}</td>
                        <td class="{{$class_table_data}} {{$item->status_peminjaman == 'Sudah di kembalikan' ? 'text-green-400' : 'text-red-400'}}">{{$item->status_peminjaman}}</td>
                    </tr>
                @endforeach

            </table>

        </div>
    @endsection

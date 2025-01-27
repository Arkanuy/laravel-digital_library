@extends('layouts.app')

@section('title', 'Peminjaman')

@section('sidebar')
    <x-layouts.user.sidebar />
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

    <div class="bg-white mx-4 my-4 p-4 rounded-lg shadow-xl">
        <div class="flex flex-row justify-between py-2">

            <h1 class="text-xl font-semibold text-slate-800">Form Peminjaman</h1>
        </div>

        <form action="{{ route('user.borrow.store') }}" class="flex flex-row w-full">
            <div class="w-full">
                <label for="buku_id" class="{{ $class_label }}">Pilih buku</label>
                <select name="buku_id" id="buku_id" class="{{ $class_input }}" required>
                    @foreach ($books as $item)
                        <option value="{{ $item->id }}">{{ $item->judul }}</option>
                    @endforeach
                </select>
                @if (session('error'))
                    <p class="text-sm text-red-500">{{ session('error') }}</p>
                @endif

                <button type="submit" class="px-2 py-1 bg-slate-600 mt-4 rounded-md text-white">
                    Pinjam
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white mx-4 my-4 p-4 rounded-lg shadow-xl">
        <div class="flex flex-row justify-between py-2">

            <h1 class="text-xl font-semibold text-slate-800">Daftar Peminjaman</h1>
        </div>
        <table class="w-full border border-slate-400 rounded-t-xl">
            <tr class="border border-slate-400 w-full">
                <th class="{{ $class_table_head }}">Id</th>
                <th class="{{ $class_table_head }}">Judul Buku</th>
                <th class="{{ $class_table_head }}">Tanggal Peminjaman</th>
                <th class="{{ $class_table_head }}">Tanggal Pengembalian</th>
                <th class="{{ $class_table_head }}">Status</th>
                <th class="{{ $class_table_head }}">Aksi</th>
            </tr>

            @foreach ($peminjaman as $item)
                <tr class="border border-slate-400 w-full">
                    <td class="{{$class_table_data}}">{{$item->id}}</td>
                    <td class="{{$class_table_data}}">{{$item->buku->judul}}</td>
                    <td class="{{$class_table_data}}">{{$item->tangal_peminjaman}}</td>
                    <td class="{{$class_table_data}}">{{$item->tanggal_pengembalian != null ? $item->tanggal_pengembalian : '...'}}</td>
                    <td class="{{$class_table_data}} {{$item->status_peminjaman == 'Sudah di kembalikan' ? 'text-green-400' : 'text-red-400'}}">{{$item->status_peminjaman}}</td>

                    <td class="{{$class_table_data}}">
                        <form action="{{route('user.borrow.update', $item->id)}}" method="POST">
                        @method('PUT')
                        @csrf

                            <button type="{{$item->status_peminjaman == 'Belum dikembalikan' ? 'submit' : 'button'}}" class=" px-2 rounded-md {{$item->status_peminjaman == 'Belum dikembalikan' ? 'bg-green-400 text-slate-800' : 'bg-green-300 text-slate-400'}}">Kembalikan</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection

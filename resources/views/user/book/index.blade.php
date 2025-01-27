@extends('layouts.app')

@section('title', 'Buku')

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

            <h1 class="text-xl font-semibold text-slate-800">Daftar Buku</h1>
        </div>
        <table class="w-full border border-slate-400 rounded-t-xl">
            <tr class="border border-slate-400 w-full">
                <th class="{{ $class_table_head }}">Id</th>
                <th class="{{ $class_table_head }}">Kategori</th>
                <th class="{{ $class_table_head }}">Judul</th>
                <th class="{{ $class_table_head }}">Penulis</th>
                <th class="{{ $class_table_head }}">Penerbit</th>
                <th class="{{ $class_table_head }}">Tahun</th>
            </tr>
            @foreach ($book as $item)
                <tr>
                    <td class="{{ $class_table_data }}">{{ $item->id }}</td>
                    <td class="{{ $class_table_data }}">
                        @foreach ($item->category as $categorys)
                            {{ $categorys->nama_kategori }}
                        @endforeach
                    </td>
                    <td class="{{ $class_table_data }}">{{ $item->judul }}</td>
                    <td class="{{ $class_table_data }}">{{ $item->penulis }}</td>
                    <td class="{{ $class_table_data }}">{{ $item->penerbit }}</td>
                    <td class="{{ $class_table_data }}">{{ $item->tahun }}</td>
                </tr>
            @endforeach
        </table>

    </div>
@endsection

@extends('layouts.app')

@section('title', 'Buku')

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
        <div>
            <h1 class="text-xl font-semibold text-slate-800">Daftar Kategori Buku</h1>

            <table class="{{ $class_table }}">
                <tr class="border border-slate-400 w-full">
                    <th class="{{ $class_table_head }}">Id</th>
                    <th class="{{ $class_table_head }}">Nama Kategori Buku</th>
                    <th class="{{ $class_table_head }}">Action</th>
                </tr>

                @foreach ($category as $item)
                    <tr>
                        <td class="{{ $class_table_data }}">{{ $item->id }}</td>
                        <td class="{{ $class_table_data }}">{{ $item->nama_kategori }}</td>
                        <td class="{{ $class_table_data }} pt-1">
                            <form action="{{ route('admin.book.destroy.kategori', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-green-600 text-slate-100 px-2 text-sm rounded-lg btn-edit"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama_kategori }}">
                                    Edit
                                </button>
                                <button type="submit"
                                    class="bg-red-600 text-slate-100 px-2 rounded-lg text-sm ">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
        <form action="{{ route('admin.book.submit.kategori') }}" method="POST"
            class="border border-slate-400 p-2 rounded-lg flex flex-col gap-2 mt-6">
            @csrf
            <h1 class="text-lg font-semibold text-slate-800">Tambah Kategori Buku</h1>
            <input type="text" name="nama_kategori" required placeholder="Masukan kategori buku"
                class="border border-slate-400 rounded-lg px-2 py-1">
            <button type="submit" class="bg-slate-600 text-slate-100 px-2 py-1 rounded-lg">Tambah</button>
        </form>
    </div>

    <div id="modal-edit-kategori" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center">
        <form action="" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            <div class="bg-white p-4 rounded-lg flex flex-col">
                <h1 class="text-center font-semibold text-2xl text-slate-800">Edit Kategori Buku</h1>
                <input type="hidden" name="id" id="edit-id">
                <input type="text" name="nama_kategori" id="edit-nama-kategori" required
                    placeholder="Masukan kategori buku" class="border border-slate-400 rounded-lg px-2 py-1">
                <button type="submit" class="bg-slate-600 text-slate-100 px-2 py-1 rounded-lg mt-2">Edit</button>
                <button type="button" id="close-modal"
                    class="bg-red-600 text-slate-100 px-2 py-1 rounded-lg mt-2">Batal</button>
            </div>
        </form>
    </div>


    <div class="bg-white mx-4 my-4 p-4 rounded-lg shadow-xl">
        <div class="flex flex-row justify-between py-2">

            <h1 class="text-xl font-semibold text-slate-800">Daftar Buku</h1>
            <button type="button" id="btn-modal-tambah-buku"
                class="bg-slate-600 text-slate-100 px-2 py-1 rounded-lg">Tambah Buku</button>
        </div>
        <table class="w-full border border-slate-400 rounded-t-xl">
            <tr class="border border-slate-400 w-full">
                <th class="{{ $class_table_head }}">Id</th>
                <th class="{{ $class_table_head }}">Kategori</th>
                <th class="{{ $class_table_head }}">Judul</th>
                <th class="{{ $class_table_head }}">Penulis</th>
                <th class="{{ $class_table_head }}">Penerbit</th>
                <th class="{{ $class_table_head }}">Tahun</th>
                <th class="{{ $class_table_head }}">Aksi</th>
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
                    <td class="{{ $class_table_data }}">

                        <form action="{{ route('admin.book.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="bg-green-600 text-slate-100 px-2 text-sm rounded-lg"
                                id="btn-edit-buku" data-id="{{ $item->id }}" data-judul="{{ $item->judul }}"
                                data-penulis="{{ $item->penulis }}" data-penerbit="{{ $item->penerbit }}"
                                data-tahun="{{ $item->tahun }}"
                                @foreach ($item->category as $categorys)
                                data-category="{{ $categorys->id }}" @endforeach>
                                Edit
                            </button>
                            <button type="submit" class="bg-red-600 text-slate-100 px-2 rounded-lg text-sm ">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div id="modal-tambah-buku" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center">
            <div class="bg-white p-4 rounded-lg flex flex-col">
                <h1 class="text-center font-semibold text-2xl text-slate-800">Tambah Buku</h1>
                <form action="{{ route('admin.book.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="judul" class="{{ $class_label }}">Judul Buku</label>
                        <input type="text" name="judul" id="judul" required placeholder="Masukan judul buku"
                            class="{{ $class_input }}">
                    </div>

                    <div>
                        <label for="penulis" class="{{ $class_label }}">Penulis Buku</label>
                        <input type="text" name="penulis" id="penulis" required placeholder="Masukan penulis buku"
                            class="{{ $class_input }}">
                    </div>

                    <div>
                        <label for="penerbit" class="{{ $class_label }}">Penerbit Buku</label>
                        <input type="text" name="penerbit" id="penerbit" required
                            placeholder="Masukan penerbit buku" class="{{ $class_input }}">
                    </div>

                    <div>
                        <label for="tahun" class="{{ $class_label }}">Tahun Terbit Buku</label>
                        <input type="number" name="tahun" id="tahun" required
                            placeholder="Masukan tahun terbit buku" class="{{ $class_input }}">
                    </div>

                    <div>
                        <label for="kategori" class="{{ $class_label }}">Kategori Buku</label>
                        <select name="kategori_id" id="kategori" class="{{ $class_input }}">
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-slate-600 text-slate-100 px-2 py-1 rounded-lg mt-2">
                        Simpan
                    </button>

                    <button type="button" id="close-modals" class="bg-red-600 text-slate-100 px-2 py-1 rounded-lg mt-2">
                        Batal
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-edit-buku" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center">
        <div class="bg-white p-4 rounded-lg flex flex-col">
            <h1 class="text-center font-semibold text-2xl text-slate-800">Tambah Buku</h1>
            <form action="" method="POST" id="form-edit-buku">
                @method('PUT')
                @csrf
                <div>
                    <label for="edit_judul" class="{{ $class_label }}">Judul Buku</label>
                    <input type="text" name="judul" id="edit_judul" required placeholder="Masukan judul buku"
                        class="{{ $class_input }}">
                </div>

                <div>
                    <label for="edit_penulis" class="{{ $class_label }}">Penulis Buku</label>
                    <input type="text" name="penulis" id="edit_penulis" required placeholder="Masukan penulis buku"
                        class="{{ $class_input }}">
                </div>

                <div>
                    <label for="edit_penerbit" class="{{ $class_label }}">Penerbit Buku</label>
                    <input type="text" name="penerbit" id="edit_penerbit" required
                        placeholder="Masukan penerbit buku" class="{{ $class_input }}">
                </div>

                <div>
                    <label for="edit_tahun" class="{{ $class_label }}">Tahun Terbit Buku</label>
                    <input type="number" name="tahun" id="edit_tahun" required
                        placeholder="Masukan tahun terbit buku" class="{{ $class_input }}">
                </div>

                <div>
                    <label for="edit_kategori" class="{{ $class_label }}">Kategori Buku</label>
                    <select name="kategori_id" id="edit_kategori" class="{{ $class_input }}">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-slate-600 text-slate-100 px-2 py-1 rounded-lg mt-2">
                    Simpan
                </button>

                <button type="button" id="close-modalss" class="bg-red-600 text-slate-100 px-2 py-1 rounded-lg mt-2">
                    Batal
                </button>
            </form>
        </div>
    </div>

@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal-edit-kategori');
        const formEdit = document.getElementById('form-edit');
        const inputId = document.getElementById('edit-id');
        const inputNamaKategori = document.getElementById('edit-nama-kategori');
        const closeModal = document.getElementById('close-modal');

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const namaKategori = button.getAttribute('data-nama');

                inputId.value = id;
                inputNamaKategori.value = namaKategori;
                formEdit.action = `/admin/buku/update/kategori/${id}`;
                modal.classList.add('flex');
                modal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const modals = document.getElementById('modal-tambah-buku');
        const closeModals = document.getElementById('close-modals');
        const btnShow = document.getElementById('btn-modal-tambah-buku');


        btnShow.addEventListener('click', () => {

            modals.classList.add('flex');
            modals.classList.remove('hidden');
        });

        closeModals.addEventListener('click', () => {
            modals.classList.add('hidden');
            modals.classList.remove('flex');
        });

        modals.addEventListener('click', (e) => {
            if (e.target === modal) {
                modals.classList.add('hidden');
                modals.classList.remove('flex');
            }
        });
    });

    // edit modal

    document.addEventListener('DOMContentLoaded', () => {
        const modalEdit = document.getElementById('modal-edit-buku');
        const formEditBuku = document.getElementById('form-edit-buku');
        const closeModalEdit = document.getElementById('close-modalss');
        const inputPenulis = document.getElementById('edit_penulis');
        const inputJudul = document.getElementById('edit_judul');
        const inputPenerbit = document.getElementById('edit_penerbit');
        const inputTahun = document.getElementById('edit_tahun');
        const inputKategori = document.getElementById('edit_kategori');

        document.querySelectorAll('#btn-edit-buku').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const penulis = button.getAttribute('data-penulis');
                const judul = button.getAttribute('data-judul');
                const penerbit = button.getAttribute('data-penerbit');
                const tahun = button.getAttribute('data-tahun');
                const kategori = button.getAttribute('data-category');

                inputPenulis.value = penulis;
                inputJudul.value = judul;
                inputPenerbit.value = penerbit;
                inputTahun.value = tahun;
                inputKategori.value = kategori;
                formEditBuku.action = `/admin/buku/update/${id}`;

                modalEdit.classList.remove('hidden');
                modalEdit.classList.add('flex');
            });
        });


        closeModalEdit.addEventListener('click', () => {
            modalEdit.classList.add('hidden');
            modalEdit.classList.remove('flex');
        });


        modalEdit.addEventListener('click', (e) => {
            if (e.target === modalEdit) {
                modalEdit.classList.add('hidden');
                modalEdit.classList.remove('flex');
            }
        });
    });
</script>

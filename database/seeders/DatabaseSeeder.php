<?php

namespace Database\Seeders;

use App\Models\admin\BookCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Arkan Mustofa P',
            'username' => 'arkan',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'email' => 'arkan@gmail.com',
            'alamat' => 'bandung'

        ]);

        User::create([
            'nama_lengkap' => 'Arkan Mustofa P',
            'username' => 'arkanjut',
            'password' => bcrypt('12345678'),
            'role' => 'user',
            'email' => 'arkan@gmail.com',
            'alamat' => 'bandung'
        ]);

        BookCategory::create([
            'nama_kategori' => 'Novel'
        ]);
    }
}

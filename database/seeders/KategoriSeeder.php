<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_kode' => 'ELC', 'kategori_nama' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_kode' => 'FAS', 'kategori_nama' => 'Fashion', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_kode' => 'MKN', 'kategori_nama' => 'Makanan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_kode' => 'OBT', 'kategori_nama' => 'Obat-obatan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_kode' => 'OTM', 'kategori_nama' => 'Otomotif', 'created_at' => now(), 'updated_at' => now()],
        ];
        
        DB::table('m_kategori')->insert($data);
    }
}

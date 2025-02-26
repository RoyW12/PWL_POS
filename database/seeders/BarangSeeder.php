<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            ['kategori_id' => 1, 'barang_kode' => 'TV001', 'barang_nama' => 'TV LED 32 Inch', 'harga_beli' => 2500000, 'harga_jual' => 3000000],
            ['kategori_id' => 1, 'barang_kode' => 'HP001', 'barang_nama' => 'Smartphone Android', 'harga_beli' => 4000000, 'harga_jual' => 4500000],
            ['kategori_id' => 2, 'barang_kode' => 'JNS001', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['kategori_id' => 2, 'barang_kode' => 'TSH001', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['kategori_id' => 3, 'barang_kode' => 'MIE001', 'barang_nama' => 'Mie Instan', 'harga_beli' => 2500, 'harga_jual' => 3000],
            ['kategori_id' => 3, 'barang_kode' => 'KOP001', 'barang_nama' => 'Kopi Bubuk', 'harga_beli' => 10000, 'harga_jual' => 12000],
            ['kategori_id' => 4, 'barang_kode' => 'VIT001', 'barang_nama' => 'Vitamin C', 'harga_beli' => 50000, 'harga_jual' => 60000],
            ['kategori_id' => 4, 'barang_kode' => 'OBT001', 'barang_nama' => 'Paracetamol', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['kategori_id' => 5, 'barang_kode' => 'OLI001', 'barang_nama' => 'Oli Motor', 'harga_beli' => 75000, 'harga_jual' => 90000],
            ['kategori_id' => 5, 'barang_kode' => 'SPK001', 'barang_nama' => 'Spakbor Motor', 'harga_beli' => 200000, 'harga_jual' => 250000],
        ];

        DB::table('m_barang')->insert($barang);
    }
}

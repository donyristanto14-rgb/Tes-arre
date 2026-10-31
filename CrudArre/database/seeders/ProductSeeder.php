<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Tambahkan produk contoh tanpa menggandakan data yang sudah ada.
     */
    public function run(): void
    {
        $products = [
            [
                'nama_produk' => 'Keyboard Mechanical',
                'kategori' => 'Aksesoris',
                'harga' => 875000,
                'stok' => 18,
                'deskripsi' => 'Keyboard mekanis dengan lampu RGB dan switch tactile.',
            ],
            [
                'nama_produk' => 'Mouse Wireless',
                'kategori' => 'Elektronik',
                'harga' => 325000,
                'stok' => 32,
                'deskripsi' => 'Mouse nirkabel ergonomis dengan sensor presisi.',
            ],
            [
                'nama_produk' => 'Headset Gaming',
                'kategori' => 'Elektronik',
                'harga' => 650000,
                'stok' => 14,
                'deskripsi' => 'Headset dengan mikrofon jernih dan suara surround.',
            ],
            [
                'nama_produk' => 'Monitor LED',
                'kategori' => 'Elektronik',
                'harga' => 2450000,
                'stok' => 8,
                'deskripsi' => 'Monitor LED 24 inci dengan resolusi Full HD.',
            ],
            [
                'nama_produk' => 'USB Flashdisk',
                'kategori' => 'Aksesoris',
                'harga' => 95000,
                'stok' => 45,
                'deskripsi' => 'Flashdisk USB 3.0 berkapasitas 64 GB.',
            ],
            [
                'nama_produk' => 'Laptop Stand',
                'kategori' => 'Peralatan Rumah',
                'harga' => 210000,
                'stok' => 20,
                'deskripsi' => 'Dudukan laptop lipat untuk membantu posisi kerja ergonomis.',
            ],
            [
                'nama_produk' => 'Charger Type-C',
                'kategori' => 'Elektronik',
                'harga' => 185000,
                'stok' => 27,
                'deskripsi' => 'Adaptor pengisian cepat USB-C berdaya 30 watt.',
            ],
            [
                'nama_produk' => 'Tas Laptop',
                'kategori' => 'Fashion',
                'harga' => 420000,
                'stok' => 12,
                'deskripsi' => 'Tas laptop 15 inci dengan kompartemen tahan percikan air.',
            ],
            [
                'nama_produk' => 'Keyboard Wireless',
                'kategori' => 'Aksesoris',
                'harga' => 390000,
                'stok' => 16,
                'deskripsi' => 'Keyboard nirkabel ringkas dengan koneksi Bluetooth.',
            ],
            [
                'nama_produk' => 'Mouse Pad',
                'kategori' => 'Aksesoris',
                'harga' => 75000,
                'stok' => 38,
                'deskripsi' => 'Mouse pad berbahan kain dengan alas anti-slip.',
            ],
        ];

        foreach ($products as $product) {
            Product::query()->firstOrCreate(
                ['nama_produk' => $product['nama_produk']],
                $product,
            );
        }
    }
}

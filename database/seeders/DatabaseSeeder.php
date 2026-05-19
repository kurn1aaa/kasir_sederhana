<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $adminRole = Role::create(['nama_role' => 'admin']);
        $userRole = Role::create(['nama_role' => 'user']);

        
     
        User::create([
            'name' => 'Administrator Kasir',
            'email' => 'admin@kasir.com',
            'password' => ('password123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Nia Kasir (Shift 1)',
            'email' => 'user@kasir.com',
            'password' => ('password123'),
            'role_id' => $userRole->id,
        ]);

    
        User::create([
            'name' => 'Fauzan Kasir (Shift 2)',
            'email' => 'user2@kasir.com', 
            'password' => bcrypt('password123'),
            'role_id' => $userRole->id,
        ]);

        $makanan = Kategori::create(['nama_kategori' => 'Bakery & Pastry']);
        $minuman = Kategori::create(['nama_kategori' => 'Coffee & Beverage']);

        $produks = [
    
            ['nama_produk' => 'Smoked Beef Croissant', 'harga' => 38000, 'stok' => 45, 'kategori_id' => $makanan->id],
            ['nama_produk' => 'Fudge Brownie Bites', 'harga' => 25000, 'stok' => 60, 'kategori_id' => $makanan->id],
            ['nama_produk' => 'Truffle Fries Accord', 'harga' => 32000, 'stok' => 20, 'kategori_id' => $makanan->id],
            ['nama_produk' => 'Classic New York Cheesecake', 'harga' => 42000, 'stok' => 15, 'kategori_id' => $makanan->id],
            ['nama_produk' => 'Almond Pain au Chocolat', 'harga' => 35000, 'stok' => 50, 'kategori_id' => $makanan->id],

            ['nama_produk' => 'Iced Sea Salt Caramel Latte', 'harga' => 28000, 'stok' => 85, 'kategori_id' => $minuman->id],
            ['nama_produk' => 'Matcha Sakura Blossom', 'harga' => 30000, 'stok' => 40, 'kategori_id' => $minuman->id],
            ['nama_produk' => 'Creamy Vanilla Cold Brew', 'harga' => 26000, 'stok' => 12, 'kategori_id' => $minuman->id],
            ['nama_produk' => 'Lychee Butterfly Pea Tea', 'harga' => 24000, 'stok' => 70, 'kategori_id' => $minuman->id],
            ['nama_produk' => 'Earl Grey Milk Tea Macchiato', 'harga' => 29000, 'stok' => 55, 'kategori_id' => $minuman->id],
            ['nama_produk' => 'Sparkling Peach Americano', 'harga' => 27000, 'stok' => 30, 'kategori_id' => $minuman->id],
        ];

        foreach ($produks as $p) {
            Produk::create($p);
        }
    }
}
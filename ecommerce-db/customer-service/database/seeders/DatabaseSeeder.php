<?php

namespace Database\Seeders;


use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        Customer::create([
            'name' => 'Roni Putra',
            'email' => 'roni@example.com',
            'phone' => '081234567890',
            'address' => 'Padang',
            'password' => '123456',
            'image' => 'https://img.freepik.com/vektor-gratis/lingkaran-biru-dengan-pengguna-putih_78370-4707.jpg?semt=ais_incoming&w=740&q=80'
        ]);

        Customer::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '082345678901',
            'address' => 'Jakarta',
            'password' => '123456',
            'image' => 'https://img.freepik.com/vektor-gratis/lingkaran-biru-dengan-pengguna-putih_78370-4707.jpg?semt=ais_incoming&w=740&q=80'
        ]);

        Customer::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'phone' => '083456789012',
            'address' => 'Bandung',
            'password' => '123456',
            'image' => 'https://img.freepik.com/vektor-gratis/lingkaran-biru-dengan-pengguna-putih_78370-4707.jpg?semt=ais_incoming&w=740&q=80'
        ]);

    }
}

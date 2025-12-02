<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Review::create([
            'customer_id' => 1,
            'product_id' => 1,
            'rating' => 5,
            'comment' => 'Sangat bagus'
        ]);

        Review::create([
            'customer_id' => 1,
            'product_id' => 2,
            'rating' => 4,
            'comment' => 'Bagus'
        ]);

        Review::create([
            'customer_id' => 2,
            'product_id' => 3,
            'rating' => 3,
            'comment' => 'Biasa saja'
        ]);
    }
}

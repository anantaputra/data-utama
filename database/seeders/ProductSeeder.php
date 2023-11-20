<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();

        $faker = Faker::create();

        foreach (range(1, 80) as $index) {
            DB::table('products')->insert([
                'name' => $faker->unique()->sentence(3),
                'price' => $faker->randomFloat(2, 5, 100),
                'stock' => $faker->numberBetween(1, 100),
                'description' => $faker->paragraph(2),
            ]);
        }
    }
}

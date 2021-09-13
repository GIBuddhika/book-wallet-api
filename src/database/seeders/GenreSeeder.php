<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            ['name' => 'Sci-fi'],
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Thriller'],
            ['name' => 'Romance'],
            ['name' => 'Westerns'],
        ]);
    }
}

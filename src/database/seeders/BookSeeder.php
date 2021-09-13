<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'user_id' => 1,
            'name' => 'jivithaya dinanne mehemayi',
            'author' => 'leelananda gamachchi',
            'description' => 'very good book to learn valuable things for life.',
            'is_public' => true,
            'isbn' => '955-652-118-6',
        ]);
    }
}

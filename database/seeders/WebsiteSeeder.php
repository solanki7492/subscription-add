<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        \DB::table('websites')->insert([
            'title'      => "Example Website",
            'url'        => 'example.com',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        \DB::table('websites')->insert([
            'title'      => "Example Website 2",
            'url'        => 'example2.com',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        \DB::table('websites')->insert([
            'title'      => "Example Website 3",
            'url'        => 'example3.com',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        \DB::table('websites')->insert([
            'title'      => "Example Website 4",
            'url'        => 'example4.com',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        \DB::table('websites')->insert([
            'title'      => "Example Website 5",
            'url'        => 'example5.com',
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}

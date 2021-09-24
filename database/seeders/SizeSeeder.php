<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::updateOrCreate([
            'name' => 'S',
            'status' => true
        ]);

        Size::updateOrCreate([
            'name' => 'M',
            'status' => true
        ]);

        Size::updateOrCreate([
            'name' => 'L',
            'status' => true
        ]);

        Size::updateOrCreate([
            'name' => 'XL',
            'status' => true
        ]);
    }
}

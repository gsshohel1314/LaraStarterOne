<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::updateOrCreate([
            'user_id' => User::orderBy('id', 'ASC')->first()->id,
            'category_id' => Category::orderBy('id', 'ASC')->first()->id,
            'name' => 'T-shart',
            'cost_price' => '200.00',
            'retail_price' => '250.00',
            'description' => "This is red t-shart.It's very cool!!",
            'status' => true
        ]);
    }
}

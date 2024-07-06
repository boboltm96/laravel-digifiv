<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cuisines = ['Chinese', 'Malay', 'Indian'];
        foreach($cuisines as $cuisine) {
            Categories::create([
                'name' => $cuisine,
                'status' => 1,
            ]);
        }
    }
}

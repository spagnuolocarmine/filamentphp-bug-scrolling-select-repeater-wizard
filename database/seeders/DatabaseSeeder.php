<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Test::factory(5)->create();
        //create 20 subitems
        \App\Models\SubItem::factory(20)->create();

        //create 10 items and add to random test
        \App\Models\Item::factory(50)->create()->each(function ($item) {
            $item->tests_id = \App\Models\Test::all()->random()->id;
            $item->save();
        });

        \App\Models\Item::all()->each(function ($item) {
            $item->sub_items_id = \App\Models\SubItem::all()->random()->id;
            $item->save();
        });


    }
}

<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create();

        foreach (range(1, 10) as $i)
        {
            $fake_str = $faker->sentence(3);

            Note::create([
                'title' => $fake_str,
                'slug'  => \Str::slug($fake_str),
                'note'  => str_repeat($fake_str, 10),
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
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
            Contact::create([
                'name'  => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
            ]);
        }

    }
}

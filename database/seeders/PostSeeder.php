<?php

namespace Database\Seeders;

use App\Models\Detail;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 4) as $index) {
           $header =  Post::create([
                'uuid' => $faker->uuid,
                'title' => $faker->sentence,
                'category' => $faker->randomElement(['music', 'food', 'finance']),
                'image' => $faker->imageUrl(),
                'slug' => $faker->slug,
                'user_id' => $faker->numberBetween(1, 2),
            ]);

            Detail::create([
                'start_date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d H:i:s'),
                'end_date' => $faker->dateTimeBetween('+1 month', '+2 months')->format('Y-m-d H:i:s'),
                'description' => $faker->paragraph,
                'tags' => json_encode(['business', 'music', 'foods', 'charity', 'health', 'finance']), // Format JSON
                'post_id' => $header->id
            ]);
        }

    }
}

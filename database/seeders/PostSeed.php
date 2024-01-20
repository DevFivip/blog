<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Tag;

class PostSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            $post = Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph(5),
                'publish_date' => $faker->dateTimeBetween('-1 month', '+1 month'),
                'author_id' => 1,
                // 'category' => $faker->word,
                'slug' => $faker->slug,
                'featured_image' => $faker->imageUrl(),
                'status' => $faker->randomElement(['draft', 'pending', 'published']),
                'views' => $faker->numberBetween(100, 1000),
                // 'comments_count' => $faker->numberBetween(0, 50),
                'meta_description' => $faker->sentence,
            ]);

            // Attach random tags to the post
            $tagIds = Tag::inRandomOrder()->limit(3)->pluck('id');
            $post->tags()->attach($tagIds);

            // Attach random cateogories to the post
            $categoriesIds = Category::inRandomOrder()->limit(3)->pluck('id');
            $post->categories()->attach($categoriesIds);
        }
    }
}

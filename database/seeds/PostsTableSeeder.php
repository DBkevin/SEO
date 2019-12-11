<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();  // 先清理表数据
        $category=Category::all()->pluck('id');
        $faker=app(Faker\Generator::class);
        $posts=factory(Post::class)->times(100)->make()->each(function ($posts) use  ($faker,$category){
            $posts->category_id=$faker->randomElement($category);
        });

        Post::insert($posts->toArray());
    }
}

<?php
use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker  $fake)
    {
        for($i = 0; $i<15; $i++){
            $post = new Post();
            $post->title = $fake->sentence(4);
            $post->description = $fake->sentence(50);
            $post->img = $fake->imageUrl(600,300, true, false);
            $post->save();
        }
    }
}

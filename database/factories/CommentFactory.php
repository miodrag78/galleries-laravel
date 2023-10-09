<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\User;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content' => $this->faker->text($maxNbChars = 1000),
            'user_id' => User::inRandomOrder()->first()->id, 
            'gallery_id' => Gallery::inRandomOrder()->first()->id,
        ];
    }
}







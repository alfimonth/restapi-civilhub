<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $imagePath = $this->faker->image('public/storage/posts', 640, 480, null, false);
        $imageData = base64_encode(file_get_contents('public/storage/posts/download.png'));

        return [
            'id_user' => rand(1,5),
            'content' => $this->faker->paragraph,
            'image' => $imageData,
            'is_anonymous' => (bool)random_int(0, 1),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
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
        return [
            'title'=>$this->faker->sentence(mt_rand(2,8)),
            'slug'=>$this->faker->slug(),
            'excerpt'=>$this->faker->paragraph(),
            // 'body'=> '<p>' . implode('</p><p>',$this->faker->paragraphs(mt_rand(10,15))) . '</p>',
            //memasukkan tag p html kedalam database menggunakan implode kyk yg ada di js

            'body'=>collect($this->faker->paragraphs(mt_rand(5,10)))->map(fn($p)=> "<p>$p</p>")->implode(''),
            //memasukkan tag p html kedalam database menggunakan collect & ero function

            'user_id'=>mt_rand(1,7),
            'category_id'=>mt_rand(1,5),
            'created_at' => Carbon::now()->subDays(rand(1, 14)),
        ];
    }
}

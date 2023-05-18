<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{

    protected $model = News::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title"=>fake()->title(),
            "image"=>fake()->imageUrl,
            "en_title"=>fake()->title(),
            "description"=>fake()->text(),
            "long_description"=>fake()->realText(),
            "views"=>fake()->numberBetween(0,9999999),
        ];
    }
}

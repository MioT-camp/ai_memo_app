<?php

namespace Database\Factories;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemoFactory extends Factory
{
    protected $model = Memo::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'body' => fake()->paragraphs(3, true),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at']);
            },
        ];
    }
}

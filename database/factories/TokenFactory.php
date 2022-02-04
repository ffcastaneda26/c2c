<?php

namespace Database\Factories;

use App\Models\Range;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'range_id'  => Range::all()->random()->id,
            'token'     => Uuid::uuid1()->toString()
        ];
    }
}

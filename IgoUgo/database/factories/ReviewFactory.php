<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Board;
use App\Models\ReviewCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reviews>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $board = Board::select('board_id')->inRandomOrder()->first();
        $area = Area::select('area_id')->inRandomOrder()->first();
        $review_cat = ReviewCategory::select('rc_type')->inRandomOrder()->first();

        return [
            'board_id' => $board->board_id,
            'area_id' => $area->area_id,
            'rc_type' => $review_cat->rc_type,
            'rate' => rand(1,5),
        ];
    }
}

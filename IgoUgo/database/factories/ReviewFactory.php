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
        $board = Board::select('board_id')->where('bc_type', '0')->inRandomOrder()->first();  // bc_type 0만 들고와야해
        $area = Area::select('area_code')->inRandomOrder()->first();
        $review_cat = ReviewCategory::select('rc_type')->inRandomOrder()->first();

        return [
            'board_id' => $board->board_id,
            'area_code' => $area->area_code,
            'rc_type' => $review_cat->rc_type,
            'rate' => rand(1,5),
        ];
    }
}

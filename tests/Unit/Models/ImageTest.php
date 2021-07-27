<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Tour;
use App\Models\Image;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->image = Image::factory()->create();
        $this->user = User::factory()->create();
        $this->tour = Tour::factory()->create(['cat_tour_id' => 1]);
        $this->review = Review::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContainsValidFillableProperties()
    {
        $this->assertEquals([
            'url',
            'imageable_type',
            'imageable_id',
        ], $this->image->getFillable());
    }

    public function testImageCanBeUploadedForUser()
    {
        $image = Image::factory()->create([
            "imageable_id" => $this->user->id,
            "imageable_type" => "users",
        ]);

        $this->assertInstanceOf(User::class, $image->imageable);
    }

    public function testImageCanBeUploadedForTour()
    {
        $image = Image::factory()->create([
            "imageable_id" => $this->tour->id,
            "imageable_type" => "tours",
        ]);

        $this->assertInstanceOf(Tour::class, $image->imageable);
    }

    public function testImageCanBeUploadedForReview()
    {
        $image = Image::factory()->create([
            "imageable_id" => $this->review->id,
            "imageable_type" => "reviews",
        ]);

        $this->assertInstanceOf(Review::class, $image->imageable);
    }
}

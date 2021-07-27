<?php

namespace Tests\Unit\Models;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->rating = Rating::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContainsValidFillableProperties()
    {
        $this->assertEquals([
            'rating',
            'status',
            'tour_id',
            'account_id',
        ], $this->rating->getFillable());
    }

    public function testBookingTourBelongsToTour()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->rating->tour());

        $this->assertEquals('tour_id', $this->rating->tour()->getForeignKeyName());
    }

    public function testBookingTourBelongsToUser()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->rating->user());

        $this->assertEquals('account_id', $this->rating->user()->getForeignKeyName());
    }
}

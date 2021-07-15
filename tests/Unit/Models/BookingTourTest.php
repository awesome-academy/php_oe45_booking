<?php

namespace Tests\Unit\Models;

use App\Models\BookingTour;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BookingTourTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->booking_tour = BookingTour::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContainsValidFillableProperties()
    {
        $this->assertEquals([
            'total_price',
            'booking_start_date',
            'status',
            'duration',
            'quantity',
            'tour_id',
            'account_id',
        ], $this->booking_tour->getFillable());
    }

    public function testBookingTourBelongsToTour()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->booking_tour->tour());

        $this->assertEquals('tour_id', $this->booking_tour->tour()->getForeignKeyName());
    }

    public function testBookingTourBelongsToUser()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->booking_tour->user());

        $this->assertEquals('account_id', $this->booking_tour->user()->getForeignKeyName());
    }
}

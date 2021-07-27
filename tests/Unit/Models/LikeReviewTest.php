<?php

namespace Tests\Unit\Models;

use App\Models\LikeReview;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LikeReviewTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->like_review = LikeReview::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContainsValidFillableProperties()
    {
        $this->assertEquals([
            'review_id',
            'account_id',
            'like_status',
        ], $this->like_review->getFillable());
    }

    public function testLikeReviewBelongsToReview()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->like_review->review());

        $this->assertEquals('review_id', $this->like_review->review()->getForeignKeyName());
    }

    public function testLikeReviewBelongsToUser()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->like_review->user());

        $this->assertEquals('account_id', $this->like_review->user()->getForeignKeyName());
    }
}

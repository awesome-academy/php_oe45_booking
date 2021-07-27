<?php

namespace Tests\Unit\Models;

use App\Models\CategoryReview;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryReviewTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->categoryReview = CategoryReview::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContainsValidFillableProperties()
    {
        $this->assertEquals([
            'name_rv_cat'
        ], $this->categoryReview->getFillable());
    }

    public function testCategoryReviewHasManyReviews()
    {
        $this->assertInstanceOf(HasMany::class, $this->categoryReview->reviews());

        $this->assertEquals('category_review_id', $this->categoryReview->reviews()->getForeignKeyName());
    }
}

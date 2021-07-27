<?php

namespace Tests\Unit\Models;

use App\Models\CategoryTour;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    protected $category_tour;
    protected $tour;

    public function setUp(): void
    {
        parent::setUp();
        $this->category_tour = CategoryTour::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCategoryTourHasManyTours()
    {
        $this->category_tour = CategoryTour::factory()->create();

        $this->assertInstanceOf(HasMany::class, $this->category_tour->tours());
        $this->assertEquals('cat_tour_id', $this->category_tour->tours()->getForeignKeyName());
    }

    public function testContainsValidFillableProperties()
    {
        $this->assertEquals(['cat_name'], $this->category_tour->getFillable());
    }
}

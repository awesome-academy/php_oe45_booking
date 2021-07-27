<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->comment = Comment::factory()->create();
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
            'content',
            'comment_parent_id',
        ], $this->comment->getFillable());
    }

    public function testCommentHasManyReplies()
    {
        $this->assertInstanceOf(HasMany::class, $this->comment->replies());

        $this->assertEquals('comment_parent_id', $this->comment->replies()->getForeignKeyName());
    }

    public function testCommentBelongsToReview()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->comment->review());

        $this->assertEquals('review_id', $this->comment->review()->getForeignKeyName());
    }

    public function testCommentBelongsToUser()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->comment->user());

        $this->assertEquals('account_id', $this->comment->user()->getForeignKeyName());
    }
}

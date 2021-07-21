<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Repositories\Review\ReviewRepositoryInterface;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(Review $review)
    {
        parent::__construct($review);
    }

    public function getReviewWithImage()
    {
        $reviews = $this->model::with('images')
            ->latest('created_at')
            ->paginate(config('app.default_paginate_review'));

        return $reviews;
    }
}

<?php

namespace App\Repositories\LikeReview;

use \App\Repositories\RepositoryInterface;

interface LikeReviewRepositoryInterface extends RepositoryInterface
{
    public function isLike($account_id, $review_id);

    public function countLike($reviewId);
}

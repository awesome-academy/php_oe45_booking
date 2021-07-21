<?php

namespace App\Repositories\LikeReview;

use App\Models\LikeReview;
use App\Repositories\BaseRepository;
use App\Repositories\LikeReview\LikeReviewRepositoryInterface;

class LikeReviewRepository extends BaseRepository implements LikeReviewRepositoryInterface
{
    public function __construct(LikeReview $like)
    {
        parent::__construct($like);
    }

    public function isLike($account_id, $review_id)
    {
        $result = $this->model::where('account_id', $account_id)->where('review_id', $review_id)->first();

        return $result;
    }

    public function countLike($reviewId)
    {
        $countLike = $this->model::where('review_id', $reviewId)->count();
        if (!empty($countLike)) {
            return $countLike;
        } else {
            return $countLike = 0;
        }
    }
}

<?php

namespace App\Repositories\ReviewCategory;

use App\Models\CategoryReview;
use App\Repositories\BaseRepository;
use App\Repositories\ReviewCategory\CatReviewRepositoryInterface;

class CatReviewRepository extends BaseRepository implements CatReviewRepositoryInterface
{
    public function __construct(CategoryReview $catReview)
    {
        parent::__construct($catReview);
    }
}

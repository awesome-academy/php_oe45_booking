<?php

namespace App\Http\Controllers;

use App\Models\LikeReview;
use App\Repositories\LikeReview\LikeReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $likeRepo;
    public function __construct(LikeReviewRepositoryInterface $likeRepo)
    {
        $this->likeRepo = $likeRepo;
    }

    public function likeReview(Request $request)
    {
        $authId = $this->likeRepo->getCurrentUser()->id;
        $like = $this->likeRepo->isLike($authId, $request->review_id);
        if (!empty($like)) {
            try {
                $this->likeRepo->delete($like->id);
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            $likeAttributes = [
                'account_id' => $authId,
                'like_status' => 1,
                'review_id' => $request->review_id,
            ];
            try {
                $this->likeRepo->create($likeAttributes);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        $numLike = $this->likeRepo->countLike($request->review_id);
        return $numLike;
    }
}

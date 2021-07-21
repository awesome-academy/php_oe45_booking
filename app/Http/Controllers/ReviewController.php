<?php

namespace App\Http\Controllers;

use App\Models\CategoryReview;
use App\Models\Image;
use App\Models\LikeReview;
use App\Models\Review;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\LikeReview\LikeReviewRepositoryInterface;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Repositories\ReviewCategory\CatReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewRepo;
    protected $catReviewRepo;
    protected $imageRepo;
    protected $likeRepo;

    public function __construct(
        ReviewRepositoryInterface $reviewRepo,
        CatReviewRepositoryInterface $catReviewRepo,
        ImageRepositoryInterface $imageRepo,
        LikeReviewRepositoryInterface $likeRepo,
    ) {
        $this->reviewRepo = $reviewRepo;
        $this->catReviewRepo = $catReviewRepo;
        $this->imageRepo = $imageRepo;
        $this->likeRepo = $likeRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = $this->reviewRepo->getReviewWithImage();

        return view('blog', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catReview = $this->catReviewRepo->getAll();
        return view('createReview', [
            'catReview' => $catReview,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUser = $this->reviewRepo->getCurrentUser();

        $attributes = [
            "title"  =>  $request->titleReview,
            "content" => $request->contentReview,
            "account_id" => $currentUser->id,
            "category_review_id" => $request->catReview,
            "count_like" => 0,
        ];
        $newReview = $this->reviewRepo->create($attributes);

        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $path = 'assets/images/uploads/thumbnailBlog/';
            $name = $thumbnail->getClientOriginalName();
            $storedPath = $thumbnail->move($path, $name);

            $attributesImage = [
                'imageable_id' => $newReview->id,
                'imageable_type' => 'reviews',
                'url' => $path . $name,
            ];
            $this->imageRepo->create($attributesImage);
        }

        return redirect()->route('home')->with("success", trans('messages.review_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catReviews = $this->catReviewRepo->getAll();
        $review = $this->reviewRepo->find($id);
        if (!$review) {
            return redirect()->route('reviews.index')->with('error', trans('messages.not_found_review'));
        }
        $images = $review->images->all();
        $user = $review->user;
        $idCurrentUser = $this->likeRepo->getCurrentUser();
        if ($idCurrentUser == null) {
            $liked = null;
        } else {
            $liked = $this->likeRepo->isLike($idCurrentUser->id, $id);
        }
        $countLike = $this->likeRepo->countLike($id);

        return view('single-blog', compact('review', 'images', 'user', 'liked', 'countLike', 'catReviews'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteReview = false;
        $reviewImage = $this->reviewRepo->find($id)->images->all();
        if (!empty($reviewImage)) {
            $deleteImage = $this->imageRepo->deleteImage($reviewImage);
            if ($deleteImage) {
                $deleteReview = $this->reviewRepo->delete($id);
            }
            if ($deleteReview) {
                return redirect()->back()->with('msg_success', trans('messages.delete_sucess'));
            }
        } else {
            $deleteReview = $this->reviewRepo->delete($id);
            if ($deleteReview) {
                return redirect()->back()->with('msg_success', trans('messages.delete_sucess'));
            }
        }
        return redirect()->back()->with('msg_fail', trans('messages.delete_fail'));
    }

    /**
     * Upload images into directory
     *
     */
    public function uploadImageToDir(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}

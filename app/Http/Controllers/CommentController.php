<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $cmtRepo;
    public function __construct(Comment $cmtRepo)
    {
        $this->cmtRepo = $cmtRepo;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['account_id'] = auth()->user()->id;
        $this->cmtRepo->create($input);

        return redirect(url()->previous() . '#position_cmt');
    }
}

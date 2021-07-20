<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Rating;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class TourRatingController extends Component
{
    public $rating;
    public $comment;
    public $currentId;
    public $product;
    public $tour;
    public $hideForm;

    protected $rules = [
        'rating' => ['required', 'in:1,2,3,4,5'],
        'comment' => 'required',

    ];

    public function render()
    {
        $rating = new Rating();
        $comment =  DB::table('ratings')
            ->join('users', 'ratings.account_id', '=', 'users.id')
            ->where('tour_id', $this->tour->id)
            ->select('*')
            ->get();
        $avgRating = $rating->getAverageRating($this->tour->id);

        $comments = [];
        for ($i = 0; $i < count($comment); $i++) {
            $commenta = (array)$comment[$i];
            array_push($comments, $commenta);
        }

        return view('livewire.product-ratings', compact('comments', 'avgRating'));
    }


    public function mount()
    {
        if (auth()->user()) {
            $rating = Rating::where('account_id', auth()->user()->id)->where('tour_id', $this->tour->id)->first();
            if (!empty($rating)) {
                $this->rating  = $rating->rating;
                $this->comment = $rating->comment;
                $this->currentId = $rating->id;
            }
        }
        return view('livewire.product-ratings');
    }


    public function delete($id)
    {
        $rating = Rating::where('id', $id)->first();
        if ($rating && ($rating->account_id == auth()->user()->id)) {
            $rating->delete();
        }
        if ($this->currentId) {
            $this->currentId = '';
            $this->rating  = '';
            $this->comment = '';
        }
    }

    public function rate()
    {
        $ratings = new Rating();
        $accountId = Auth::user()->id;
        $rating = Rating::where('account_id', $accountId)->where('tour_id', $this->tour->id)->first();
        $tour = Tour::where('id', $this->tour->id)->first();
        //dd($this->tour->id);

        if (!empty($rating)) {
            $rating->account_id = auth()->user()->id;
            $rating->tour_id = $this->tour->id;
            $rating->rating = $this->rating;
            $rating->comment = $this->comment;
            $rating->status = 1;
            try {
                $rating->update();
            } catch (\Throwable $th) {
                throw $th;
            }

            session()->flash('message', 'Success!');
            $this->hideForm = true;
        } else {
            $rating = new Rating;
            $rating->account_id = auth()->user()->id;
            $rating->tour_id = $this->tour->id;
            $rating->rating = $this->rating;
            $rating->comment = $this->comment;
            $rating->status = 1;
            try {
                $rating->save();
            } catch (\Throwable $th) {
                throw $th;
            }
            $this->hideForm = true;
        }

        if (!empty($tour)) {
            $avarageRate = $ratings->getAverageRating($this->tour->id);
            if (empty($avarageRate)) {
                $tour->avgRate = 0;
            } else {
                $tour->avgRate = $avarageRate;
            }
            try {
                $tour->save();
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}

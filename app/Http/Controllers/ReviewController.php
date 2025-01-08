<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(string $id, Request $request){
        $comment=Comment::create([
            "comment" => $request->product_reviews,
            "users_id" => Auth::user()->id,
        ]);

        ProductReview::create(
            [
                "comments_id" => $comment->id,
                "products_id" => $id
            ]
        );

        return redirect()->back();
    }
}

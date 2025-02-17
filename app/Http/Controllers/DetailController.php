<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class DetailController extends Controller
{
    public function ShowProduct(Request $request, string $slug){
        $product=Product::with(["galleries","user"])->where("slug",$slug)->firstOrFail();
        $reviews= ProductReview::with(['comment.user'])
                                ->where('products_id', $product->id)
                                ->get()
                                ->map(function ($review) {
                                    return [
                                        'id' => $review->id,
                                        'product_id' => $review->products_id,
                                        'user_name' => $review->comment->user->name ?? 'Unknown User',
                                        'comment' => $review->comment->comment ?? 'No Comment'
                                    ];
                                });
                                
        
        return view("pages.detail", [
            "product" => $product,
            "reviews" => $reviews
        ]);
    }
}

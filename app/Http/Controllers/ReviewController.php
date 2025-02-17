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

    public function destroy(string $id, string $productId){
        $userId=Auth::user()->id;
        $comment=Comment::select("users_id")
                            ->where("id",$id)
                            ->first();

        $resMessage=[
            "success" => true,
            "errors" => false,
            "message" => "Success delete review."
        ];

        if (!$comment) {
            $resMessage['success']=false;
            $resMessage['errors']=true;
            $resMessage['message']='Review not found.';
            return response()->json($resMessage, 404);
        }

        if($userId === $comment->users_id){
            $comment->delete();
        
            ProductReview::where('id',$id)
                       ->where('products_id',$productId)->delete();

            return response()->json($resMessage,200);  
        }else{
            $resMessage['success']=false;
            $resMessage['errors']=true;
            $resMessage['message']='Unauthorization, cannot delete review';

            return response()->json($resMessage,403);
        } 
    }
}

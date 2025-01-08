<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded=["id"];

    protected $table="product_reviews";


    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comments_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

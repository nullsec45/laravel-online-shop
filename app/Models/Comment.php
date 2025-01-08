<?php

namespace App\Models;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded=["id"];

    protected $table="product_comments";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"users_id")->select("id","name");
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(ProductReview::class, 'id', 'comments_id');
    }
}

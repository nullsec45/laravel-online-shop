<?php

namespace App\Models;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        "name",
        "users_id",
        "categories_id",
        "price",
        "description",
        "slug"
    ];

    protected $hidden=[
        "created_at",
        "updated_at"
    ];

    public function galleries(){
        return $this->hasMany(ProductGallery::class, "products_id","id");
    }

    public function user(){
        return $this->hasOne(User::class,"id","users_id");
    }

    public function category(){
        return $this->belongsTo(Category::class,"categories_id","id");
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
}

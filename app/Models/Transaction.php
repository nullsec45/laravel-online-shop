<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $hidden=["crreated_at","updated_at","deleted_at"],
             $fillable=[
               "users_id",
               "insurance_price",
               "shipping_price",
               "transaction_status",
               "code",
               "total_price"
             ];

  public function user(){
    return $this->belongsTo(User::class,"users_id","id");
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $hidden=["crreated_at","updated_at","deleted_at"],
             $fillable=[
               "users_id",
               "transactions_id",
               "code",
               "price",
               "products_id",
               "shipping_status",
               "resi"
             ]; 
}

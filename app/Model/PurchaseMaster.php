<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseMaster extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'user_id', 'total_invoice', 'discount', 'discount_unit', 'amount_paid', 'amount_due'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}

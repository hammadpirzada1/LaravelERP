<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderMaster extends Model
{
	use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'status', 'payment', 'discount', 'discount_unit', 'purchase_unit'];
	
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function product_masters()
    {
        return $this->belongsToMany('App\Model\ProductMaster' , 'order_item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

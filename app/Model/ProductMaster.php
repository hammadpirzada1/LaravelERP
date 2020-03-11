<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMaster extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'product_category_id', 'unit_id', 'inventory_val', 'price', 'discount', 'threshold', 'status', 'short_desc', 'long_desc',  'created_by', 'modified_by'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    

    public function product_category()
    {
        return $this->belongsTo('App\Model\ProductCategory');
    }

    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class);
    }

    public function order_masters()
    {
        return $this->belongsToMany('App\Model\OrderMaster', 'order_item');
    }

    public function unit()
    {
        return $this->belongsTo('App\Model\Unit');
    }

}

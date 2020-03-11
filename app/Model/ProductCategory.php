<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
	use SoftDeletes;
	
	protected $fillable = ['title', 'parent_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function product_master()
    {
        return $this->hasMany('App\Model\ProductMaster');
    }
}

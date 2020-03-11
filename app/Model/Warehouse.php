<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'location', 'status'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function productmaster()
    {
        return $this->belongsToMany(ProductMaster::class);
    }
}

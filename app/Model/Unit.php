<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany('App\Model\ProductMaster');
    }
}

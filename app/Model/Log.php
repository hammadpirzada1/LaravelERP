<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['module_name', 'user_id'];
	
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function log_user()
    {
        return $this->belongsTo('App\User');
    }
}

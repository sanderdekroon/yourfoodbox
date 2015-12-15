<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}

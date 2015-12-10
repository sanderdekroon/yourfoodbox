<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{

    protected $fillable = ['order_id', 'product_id', 'amount'];
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }
}

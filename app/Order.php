<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'status', 'city_id'];
    
    
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderlines()
    {
        return $this->hasMany('App\Orderline');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}

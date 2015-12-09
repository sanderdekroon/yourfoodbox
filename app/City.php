<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    
    /**
    * A city can have many products.
    *
    * Makes it possible to find (a) product(s) by city_id
    * $city = App\City::findOrFail($id);
    * $city->products()->get()->toArray();
    * **OR** $city->products->toArray();
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}

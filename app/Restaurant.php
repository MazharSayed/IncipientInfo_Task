<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function restaurantImage()
    {
        return $this->hasOne(RestaurantImage::class,  'restaurant_id');
    }
}

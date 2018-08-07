<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function product()
    {
      return $this->hasOne('App\Product');
    }

    public function seller()
    {
      return $this->belongsTo('App\Seller');
    }

    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }
}

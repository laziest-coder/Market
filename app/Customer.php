<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function contact()
    {
      return $this->hasOne('App\CustomerContact');
    }

    public function offer()
    {
      return $this->hasMany('App\Offer');
    }

    public function order()
    {
      return $this->hasMany('App\Order');
    }
}

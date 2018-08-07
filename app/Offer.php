<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';

    public function seller()
    {
      return $this->belongsTo('App\Seller');
    }

    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }
}

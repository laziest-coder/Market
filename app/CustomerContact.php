<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    protected $table = 'customer_contact';

    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }
}

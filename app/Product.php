<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public function sub_product_category()
    {
    	return $this->belongsTo('App\SubProductCategory');
    }
    public function seller()
    {
      return $this->belongsTo('App\Seller','seller_id');
    }
    public function orders()
    {
      return $this->belongsTo('App\Order');
    }
}

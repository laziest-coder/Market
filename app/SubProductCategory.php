<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProductCategory extends Model
{
    protected $table = 'sub_products_category';

    public $timestamps = false;

    public function product_category()
    {
      return $this->belongsTo('App\ProductCategory');
    }
    public function products()
    {
      return $this->hasMany('App\Product');
    }
}

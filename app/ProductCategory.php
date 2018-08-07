<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'products_category';

    public $timestamps = false;

    protected $fillable = ['name'];

    public function sub_product_category()
    {
    	return $this->hasMany('App\SubProductCategory');
    }
}

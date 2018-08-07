<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
	protected $table = 'sellers';

		public function user()
		{
			return $this->hasOne('App\User');
		}

    public function contact()
    {
    	return $this->hasOne('App\SellerContact');
    }

		public function product()
		{
			return $this->hasMany('App\Product');
		}

		public function offer()
		{
			return $this->hasOne('App\Offer');
		}

		public function order()
		{
			return $this->hasMany('App\Order');
		}

}

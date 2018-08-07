<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SellerContact extends Model
{
	protected $table = 'seller_contacts';

    public function seller()
    {
    	return $this->belongsTo('App\Seller');
    }
}

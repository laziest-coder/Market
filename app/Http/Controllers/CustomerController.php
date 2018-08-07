<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\Order;
use App\Customer;
use App\Offer;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    public function vendors()
    {
      $sellers = Seller::all();
      return view('customer.vendors')->withSellers($sellers);
    }

    public function orders()
    {
      $customer = Customer::where('user_id',Auth::user()->id)->first();
      if($customer != null){
        $orders = Order::where('customer_id',$customer->id)->get();
        if(count($orders) ==0){
          $orders = 'noorders';
          return view('customer.orders')->withOrders($orders);
        }else{
            return view('customer.orders')->withOrders($orders);
        }
      }else{
        $orders = 'notregistered';
        return view('customer.orders')->withOrders($orders);
      }
    }
    public function offers(Request $request)
    {
      $customer = Customer::where('user_id',Auth::user()->id)->first();
      if($customer != null){
        $offers = Offer::where('customer_id',$customer->id)->orderBy('id','desc')->get();
        return view('customer.offers')->withOffers($offers);
      }else{
        $offers = 'notaddedinfo';
        return view('customer.offers')->withOffers($offers);
      }
    }
    public function offeraccept(Request $request)
    {
      $offer = Offer::where('id',$request->offer_id)->first();
      return view('customer.offerbody')->withOffer($offer);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Seller;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Session;

class SellerController extends Controller
{

    public function orders()
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $seller = Seller::where('user_id',Auth::user()->id)->first();
        if($seller != null){
          $orders = Order::where('seller_id',$seller->id)->get();
          if(count($orders) == 0) {
              $orders = 'noorders';
              return view('seller.orders')->withOrders($orders);
          }else{
              return view('seller.orders')->withOrders($orders);
          }
        }else{
          $orders = 'notregistered';
          return view('seller.orders')->withOrders($orders);
        }
      }
    }
    public function clients()
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $seller = Seller::where('user_id',Auth::user()->id)->first();
        if($seller != null ){
          $customers = Order::distinct()->select('customer_id')->where('seller_id',$seller->id)->paginate(6);
          // dd($customers);
          // die();
          if($customers != null){
            if(count($customers) > 0){
                return view('seller.clients')->withCustomers($customers);
            }else{
                $customers = 'nocustomerfound';
                return view('seller.clients')->withCustomers($customers);
            }
          }else{
            $customers = 'nocustomerfound';
            return view('seller.clients')->withCustomers($customers);
          }
        }else {
          $customers = 'notaddedinfo';
          return view('seller.clients')->withCustomers($customers);
        }
      }
    }
    public function orderverify(Request $request)
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $order = Order::where('id',$request->order_id)->first();
        $customer = Customer::where('id',$order->customer_id)->first();
        return view('seller.orderverify')->withOrder($order)->withCustomer($customer);
      }
    }
    public function verifycomplete(Request $request)
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $this->validate($request,array(
            'planned_on' => 'required'
        ));
        $order = Order::where('id',$request->order_id)->first();
        $order->planned_on = $request->planned_on;
        $order->status = 'finished';
        $order->save();
        Session::flash('verified', 'Вы успешно одобрели дату доставление продукта!');
        return redirect()->route('orders');
      }
  }
}

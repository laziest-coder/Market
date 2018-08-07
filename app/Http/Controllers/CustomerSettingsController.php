<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomerContact;
use App\Offer;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Session;
use Storage;
class CustomerSettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::where('user_id',Auth::user()->id)->get();
        if(count($customer)>0){
            return view('customer.settings')->withCustomer($customer);
        }else{
            return view('customer.settings');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $seller = Customer::where('user_id',Auth::user()->id)->get();
      if(count($seller) !=0){
        Session::flash('custexists','Вы уже добавили информацию про вашего организации!');
        return redirect()->route('cust_settings.index');
      }else{
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'info' => 'required|string',
            'fio' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|numeric'
        ));
        $customer = new Customer;
        $customerContact = new CustomerContact;
        if($request->hasFile('image')){
          $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
          $request->file('image')->move(public_path('img/customers'), $imageName);
          $customer->image = $imageName;
        }
        $customer->name = $request->name;
        $customer->owner = $request->owner;
        $customer->website = $request->website;
        $customer->address = $request->address;
        $customer->info = $request->info;
        $customer->user_id = Auth::user()->id;
        $customer->save();
        $id = Customer::where('user_id',Auth::user()->id)->get();
        $customerContact->customer_id = $id[0]->id;
        $customerContact->fio = $request->fio;
        $customerContact->email = $request->email;
        $customerContact->phoneNumber = $request->phoneNumber;
        $customerContact->save();
        Session::flash('custcreated','Вы успешно добавили вашего учетную запись!');
        return redirect()->route('cust_settings.index');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::where('user_id',$id)->get();
        if(count($customer) != 0){
          return view('customer.settingsedit')->withCustomer($customer);
        } else {
          Session::flash('notaddedinfo','Вы еще не добавили информацию про организации!');
          return redirect()->route('cust_settings.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, array(
          'name' => 'required|string|max:255',
          'owner' => 'required|string|max:255',
          'address' => 'required|string|max:255',
          'info' => 'required|string',
          'fio' => 'required|string|max:255',
          'email' => 'required|email|max:255',
          'phoneNumber' => 'required|numeric'
      ));
      $customer = Customer::where('user_id',Auth::user()->id)->first();
      $customerContact = CustomerContact::where('customer_id',$customer->id)->first();
      if($request->image){
        $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('img/customers'), $imageName);
        $oldName = 'customers/'.$customer->image;
        $customer->image = $imageName;
        Storage::delete($oldName);
      }
      $customer->image = $request->image;
      $customer->name = $request->name;
      $customer->owner = $request->owner;
      $customer->website = $request->website;
      $customer->address = $request->address;
      $customer->info = $request->info;
      $customer->user_id = Auth::user()->id;
      $customer->save();
      $id = Customer::where('user_id',Auth::user()->id)->get();
      $customerContact->customer_id = $customer->id;
      $customerContact->fio = $request->fio;
      $customerContact->email = $request->email;
      $customerContact->phoneNumber = $request->phoneNumber;
      $customerContact->save();
      Session::flash('custedited','Вы успешно изменили вашего учетную запись!');
      return redirect()->route('cust_settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('user_id',$id)->first();
        if($customer != null ){
          $offers = Offer::where('customer_id',$customer->id)->get();
          foreach($offers as $offer){
            $offer->delete();
          }
          $orders = Order::where('customer_id',$customer->id)->get();
          foreach($orders as $order){
            $order->delete();
          }
          $customer->contact()->delete();
          if($customer->image != null){
            $image = 'customers/'.$seller->image;
            Storage::delete($image);
          }
          $customer->delete();
          Session::flash('custdeleted','Вы успешно удалили свою учетную запись!');
          return redirect()->route('cust_settings.index');
        }else{
          Session::flash('notaddedinfo','Вы еше не добавили информацию про вашего организации!');
          return redirect()->route('cust_settings.index');
        }
    }
}

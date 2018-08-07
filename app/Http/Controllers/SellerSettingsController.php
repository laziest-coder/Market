<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\SellerContact;
use App\User;
use App\Order;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Session;
class SellerSettingsController extends Controller
{

    public function check()
    {
      Session::put('user_id',Auth::user()->id);
        if(Session::get('user_id') == null){
          return redirect()->route('login');
        }
        if(Auth::user()->role == 'seller'){
            return redirect()->route('orders');
        }else if(Auth::user()->role == 'customer'){
            return redirect()->route('order');
        }else if(Auth::user()->role == 'admin'){
            return redirect()->route('adminorders');
        }

    }

    public function vendor()
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $users = Seller::all()->where('user_id',Auth::user()->id);
        return view('seller.orders')->withUsers($users);
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        // $seller = Seller::all()->where('user_id','=',$id);
        return view('seller.settings');
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
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $seller = Seller::where('user_id',Auth::user()->id)->get();
        if(count($seller) !=0){
          Session::flash('custexists','Вы уже добавили информацию про организации!');
          return redirect()->route('settings.index');
        }else{
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'image' => 'nullable',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'info' => 'required|string',
            'fio' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|numeric'
        ));
          $seller = new Seller;
          $sellerContact = new SellerContact;
          if($request->hasFile('image')){
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img/sellers'), $imageName);
            $seller->image = $imageName;
          }
          $seller->name = $request->name;
          $seller->owner = $request->owner;
          $seller->website = $request->website;
          $seller->address = $request->address;
          $seller->info = $request->info;
          $seller->user_id = Auth::user()->id;
          $seller->save();
          $id = Seller::where('user_id',Auth::user()->id)->get();
          $sellerContact->seller_id = $id[0]->id;
          $sellerContact->fio = $request->fio;
          $sellerContact->email = $request->email;
          $sellerContact->phoneNumber = $request->phoneNumber;

          $sellerContact->save();

          Session::flash('sellercreated','Вы успешно активировали свою учетную запись!');

          return redirect()->route('settings.index');
        }
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
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $seller = Seller::where('user_id',$id)->get();
        if(count($seller) != 0){
          return view('seller.settingedit')->withSeller($seller);
        } else {
          Session::flash('notaddedinfo','Вы еще не добавили информацию про организации!');
          return redirect()->route('settings.index');
        }
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
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'image' => 'nullable',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'info' => 'required|string',
            'fio' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|numeric'
        ));
        $seller = Seller::where('user_id',Auth::user()->id)->first();
        $sellerContact = SellerContact::where('seller_id',$seller->id)->first();
        if($request->image){
          $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
          $request->file('image')->move(public_path('img/sellers'), $imageName);
          $oldName = 'sellers/'.$seller->image;
          $seller->image = $imageName;
          Storage::delete($oldName);
        }
        $seller->name = $request->name;
        $seller->owner = $request->owner;
        $seller->website = $request->website;
        $seller->address = $request->address;
        $seller->info = $request->info;
        $seller->user_id = Auth::user()->id;
        $seller->save();
        $sellerContact->seller_id = $seller->id;
        $sellerContact->fio = $request->fio;
        $sellerContact->email = $request->email;
        $sellerContact->phoneNumber = $request->phoneNumber;
        $sellerContact->save();
        Session::flash('custedited','Вы успешно изменили информацию про организации!');
        return redirect()->route('settings.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(Auth::user()->role != 'seller'){
          return view('layouts.error');
      }else{
      $seller = Seller::where('user_id',$id)->first();
      if($seller != null){
        $seller->contact()->delete();
        $products = Product::where('seller_id',$seller->id)->get();
        foreach($products as $product){
          if($product->image != null){
            $image = 'products/'.$product->image;
            Storage::delete($image);
          }
          $product->delete();
        }
        $orders = Order::where('seller_id',$seller->id)->get();
        foreach($orders as $order){
          $order->delete();
        }
        $offers = Offer::where('seller_id',$seller->id)->get();
        foreach($offers as $offer){
          $offer->delete();
        }
        if($seller->image != null){
          $image = 'sellers/'.$seller->image;
          Storage::delete($image);
        }
        $seller->delete();
        Session::flash('custdeleted','Вы успешно удалили свою учетную запись!');
        return redirect()->route('settings.index');
      }else{
        Session::flash('notaddedinfo','Вы еще не добавили информацию про вашего организации!');
        return redirect()->route('settings.index');
      }
    }
  }
}

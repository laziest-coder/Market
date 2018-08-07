<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubProductCategory;
use App\Order;
use App\Seller;
use Illuminate\Support\Facades\Auth;
use Session;
use Storage;

class CatalogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Seller::where('user_id',Auth::user()->id)->get();
        if(count($seller) != 0){
          $products = Product::where('seller_id',$seller[0]->id)->paginate(6);
          if(count($products) != 0){
            return view('seller.catalogs',compact('products'));
          }else{
            $products = 'noproductfound';
            return view('seller.catalogs',compact('products'));
          }
        }else{
          $products = 'notaddedinfo';
          return view('seller.catalogs',compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subs = SubProductCategory::all();
        return view('seller.create')->withSubs($subs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->sale == 'on'){
        $this->validate($request,[
            'sale_amount' => 'required|numeric'
        ]);
      }
      $this->validate($request, array(
          'name' => 'required|max:255',
          'description' => 'required',
          'image' => 'nullable',
          'price' => 'required|integer'
      ));
        $sub = SubProductCategory::where('name',$request->sub_product_category_id)->first();
        $seller = Seller::where('user_id',Auth::user()->id)->first();
        $product = new Product;
        if($request->hasFile('image')){
          $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
          $request->file('image')->move(public_path('img/products'), $imageName);
          $product->image = $imageName;
        }
        $product->name = $request->name;
        $product->sub_product_category_id = $sub->id;
        $product->seller_id = $seller->id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_amount = $request->sale_amount;
        if($request->sale_amount != ''){
          $product->sale = 1;
          if($request->sale_amount == 0){
              $product->price_sale = null;
          }else{
            $product->price_sale = $request->price-($request->price/$request->sale_amount);
          }
        }
        $product->save();

        Session::flash('success', 'Вы успешно добавили этот каталог!');
        return redirect()->route('catalogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $subs = SubProductCategory::all();
        return view('seller.edit')->withSubs($subs)->withProduct($product);
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
          'name' => 'required|max:255',
          'price' => 'required|integer',
          'sale_amount' => 'integer'
      ));
      $sub = SubProductCategory::where('name',$request->sub_product_category_id)->get();
      $seller = Seller::where('user_id',Auth::user()->id)->get();
      $product = Product::find($id);
      if($request->image){
        $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('img/products'), $imageName);
        $oldName = 'products/'.$product->image;
        $product->image = $imageName;
        Storage::delete($oldName);
      }
      $product->name = $request->name;
      $product->price = (int)$request->price;
      $product->sale_amount = $request->sale_amount;
      if($request->sale_amount != ''){
        $product->sale = 1;
        $product->price_sale = $request->price-($request->price/$request->sale_amount);
      }
      $product->sub_product_category_id = $sub[0]->id;
      $product->seller_id = $seller[0]->id;
      $product->save();
      Session::flash('edit','Вы успешно изменили этот каталог!');
      return redirect()->route('catalogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $orders = Order::where('products_id',$product->id)->get();
        foreach($orders as $order){
          $order->delete();
        }
        if($product->image != null){
          $image = 'products/'.$product->image;
          Storage::delete($image);
        }
        $product->delete();
        Session::flash('danger', 'Вы успешно удалили этого каталог!');
        return redirect()->route('catalogs.index');
    }
}

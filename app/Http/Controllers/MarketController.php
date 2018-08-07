<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Seller;
use App\Customer;
use App\ProductCategory;
use App\SubProductCategory;
use App\Offer;
use Session;

use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index','vendorinfo','vendorcatalogs','vendors','subcategorypros','bigcategorypros','customerinfo','customers','about']);
    }

    public function index()
    {
      $products = Product::orderBy('id','desc')->paginate(9);
      // dd($products->links());
      // die();
      return view('market.market')->withProducts($products);
    }
    public function order(Request $request)
    {
      $product = Product::where('id',$request->product_id)->get();
      $customer = Customer::where('user_id',Auth::user()->id)->first();
      if($customer != null){
          return view('market.orders')->withCustomer($customer)->withProduct($product);
      }else{
        $customer = 'notaddedinfo';
        return view('market.orders')->withCustomer($customer)->withProduct($product);
      }
    }
    public function productInfo(Request $request)
    {
      $product = Product::where('id',$request->product_id)->get();
      $customer = Customer::where('user_id',Auth::user()->id)->first();
      if($customer != null){
          return view('market.productinfo')->withProduct($product)->withCustomer($customer);
      }else{
        $customer = 'notaddedinfo';
        return view('market.productinfo')->withProduct($product)->withCustomer($customer);
      }
    }
    public function buy(Request $request)
    {
      $this->validate($request, array(
          'quantity' => 'required|integer'
      ));

      $product = new Order;
      $product->products_id = $request->products_id;
      $product->customer_id = $request->customer_id;
      $product->seller_id = $request->seller_id;
      $product->comment = $request->comment;
      $product->price = $request->quantity*$request->price;
      $product->quantity = $request->quantity;
      $product->save();
      return redirect('/market');
    }
    public function vendorinfo(Request $request)
    {
      $seller = Seller::where('id',$request->vendor_id)->get();
      return view('market.vendor', compact('seller'));
    }
    public function vendorcatalogs(Request $request)
    {
      $products = Product::where('seller_id',$request->vendor_id)->paginate(9);
      $seller = Seller::where('id',$request->vendor_id)->first();
      return view('market.vendorproduct')->withProducts($products)->withSeller($seller);
    }
    public function vendors()
    {
      $sellers = Seller::orderBy('id','desc')->paginate(9);
      return view('market.vendors')->withSellers($sellers);
    }
    public function customers()
    {
      $customers = Customer::orderBy('id','desc')->paginate(9);
      return view('market.customers')->withCustomers($customers);
    }
    public function customerinfo(Request $request)
    {
      $customer = Customer::where('id',$request->customer_id)->get();
      return view('market.customer', compact('customer'));
    }
    public function bigcategorypros(Request $request)
    {
      $bigcat = ProductCategory::where('id',$request->category_id)->first();
      $subcat = $bigcat->sub_product_category()->get();
      // dd($subcat);
      // die();
      return view('market.bigcatpros')->withSubcat($subcat)->withBigcat($bigcat);
    }
    public function subcategorypros(Request $request)
    {
      $products = SubProductCategory::where('id',$request->category_id)->first();
      $pros = Product::where('sub_product_category_id',$products->id)->paginate(9);
      return view('market.subcatpros')->withProducts($products)->withPros($pros);
    }
    public function search(Request $request)
    {
      $products = Product::where('name','LIKE','%'.$request->search.'%')->get();
      $sellers = Seller::where('name','LIKE','%'.$request->search.'%')->get();
      $customers = Customer::where('name','LIKE','%'.$request->search.'%')->get();
      return view('market.searchresult')->withProducts($products)->withSellers($sellers)->withCustomers($customers);
    }
    public function offer(Request $request)
    {
      $customer = Customer::find($request->customer_id);
      return view('market.offer')->withCustomer($customer);
    }
    public function customeroffer(Request $request)
    {
      $this->validate($request, array(
          'comment' => 'required'
      ));
      $seller = Seller::where('user_id',Auth::user()->id)->first();
      $offer = new Offer;
      $offer->comment = $request->comment;
      $offer->customer_id = $request->customer_id;
      $offer->seller_id = $seller->id;
      $offer->save();
      Session::flash('offered','Вы успешно предложили услуги!');
      return redirect('market/customers');
    }
    public function about()
    {
      return view('market.about');
    }
}

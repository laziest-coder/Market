<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Offer;
use App\User;
use App\Seller;
use App\Customer;
use App\ProductCategory;
use App\SubProductCategory;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;

class AdminController extends Controller
{
    public function orders()
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $orders = Order::all();
        return view('admin.orders')->withOrders($orders);
      }
    }

    public function addcategory()
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $category = ProductCategory::all();
        return view('admin.addcategory')->withCategory($category);
      }
    }

    public function addui()
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        return view('admin.add');
      }
    }

    public function catpost(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $this->validate($request,array(
            'image' => 'required|max:2047'
        ));
        $separate = explode(',',$request->sub);
        $helper = true;
        foreach($separate as $sep){
          while($helper != false){
            $category = new ProductCategory;
            $category->name = $request->name;
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img/defaults'), $imageName);
            $category->image = $imageName;
            $category->save();
            $helper = false;
          }
          $sub = new SubProductCategory;
          $cat = ProductCategory::where('name',$request->name)->first();
          $sub->name = trim($sep);
          $sub->product_category_id = $cat->id;
          $sub->save();
        }
        Session::flash('categoryadded','Вы успешно добавили категории!');
        return redirect()->route('addcategory');
      }
    }

    public function edit(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $category = ProductCategory::find($request->category_id);
        $subcat = $category->sub_product_category()->get();
        $array = '';
        foreach($subcat as $sub){
            $array=$array.','.$sub->name;
        }
        // dd(trim($array));
        return view('admin.edit')->withCategory($category)->withArray($array);
      }
    }

    public function update(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $this->validate($request,array(
            'name' => 'required'
        ));
        $category = ProductCategory::find($request->category_id);
        $i = 1;
        $category->name = $request->name;
        if($request->image != null){
          $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
          $request->file('image')->move(public_path('img/defaults'), $imageName);
          $oldName = 'defaults/'.$category->image;
          $category->image = $imageName;
          Storage::delete($oldName);
        }
        $category->save();
        Session::flash('categoryedited','Вы успешно изменили категории!');
        return redirect()->route('addcategory');
      }
    }

    public function subcategories(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $bigcats = ProductCategory::find($request->product_id);
        $subcats = $bigcats->sub_product_category()->get();
        return view('admin.subcategories')->withSubcats($subcats);
      }
    }

    public function subcategoriesedit(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $subcat = SubProductCategory::find($request->subcat_id);
        $bigcat = ProductCategory::find($request->product_id);
        return view('admin.subcategoriesedit')->withSubcat($subcat)->withBigcat($bigcat);
      }
    }

    public function subcategoryadd(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $category = ProductCategory::find($request->product_id);
        return view('admin.subcatadd')->withCategory($category);
      }
    }

    public function subcataddpost(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $subcat = new SubProductCategory;
        $subcat->name = $request->sub;
        $subcat->product_category_id = $request->product_id;
        $subcat->save();
        return redirect()->route('product.subcategories',['product_id' => $request->product_id]);
      }
    }

    public function subcatput(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $subcat = SubProductCategory::find($request->subcat_id);
        $subcat->name = $request->sub;
        $subcat->save();
        return redirect()->route('product.subcategories',['product_id' => $subcat->product_category->id]);
      }
    }

    public function subcatdelete(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $subcat = SubProductCategory::find($request->subcat_id);
        $products = Product::where('sub_product_category_id',$subcat->id)->get();
        foreach($products as $product){
          if($product->image != null){
            $image = 'products/'.$product->image;
            Storage::delete($image);
          }
          $orders = Order::where('products_id',$product->id)->get();
          foreach($orders as $order){
            $order->delete();
          }
          $product->delete();
        }
        $subcat->delete();
        return redirect()->route('product.subcategories',['product_id' => $subcat->product_category->id]);
      }
    }

    public function categorydelete(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $category = ProductCategory::find($request->category_id);
        if($category->image != null){
          $image = 'defaults/'.$category->image;
          Storage::delete($image);
        }
        $subcategory = SubProductCategory::where('product_category_id',$category->id)->get();
        foreach($subcategory as $sub){
          $products = Product::where('sub_product_category_id',$sub->id)->get();
          foreach($products as $product){
            if($product->image != null){
              $image = 'products/'.$product->image;
              Storage::delete($image);
            }
            $orders = Order::where('products_id',$product->id)->get();
            foreach($orders as $order){
              $order->delete();
            }
            $product->delete();
          }
        }
        $category->sub_product_category()->delete();
        $category->delete();
        return redirect()->route('addcategory');
      }
    }

    public function users()
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $users = User::where('is_valid','0')->where('role','!=','admin')->get();
        return view('admin.users')->withUsers($users);
      }
    }

    public function userverify(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $user = User::find($request->user_id);
        if($user->role == 'seller'){
          $data = Seller::where('user_id',$user->id)->first();
        }else{
          $data = Customer::where('user_id',$user->id)->first();
        }
        if($data != null){
          return view('admin.userverify')->withData($data)->withUser($user);
        }else{
            $data = 'notfound';
            return view('admin.userverify')->withData($data)->withUser($user);
        }
      }
    }

    public function userveirfycomplete(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $this->validate($request,array(
            'active' => 'required'
        ));
        $user = User::find($request->user_id);
        if($request->active == 'on'){
          $user->is_valid = 1;
          $user->save();
          return redirect()->route('adminusers');
        }
      }
    }

    public function allusers()
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $users = User::orderBy('id','desc')->where('name','!=','admin')->paginate(6);
        return view('admin.allusers')->withUsers($users);
      }
    }

    public function userinfo(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $user = User::find($request->user_id);
        if($user->role == 'seller'){
          $data = Seller::where('user_id',$user->id)->first();
        }else{
          $data = Customer::where('user_id',$user->id)->first();
        }
        if($data != null){
          return view('admin.userinfo')->withData($data)->withUser($user);
        }else{
            $data = 'notfound';
            return view('admin.userinfo')->withData($data)->withUser($user);
        }
      }
    }

    public function userdelete(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
          $user = User::find($request->user_id);
          if($user->role == 'seller'){
            $data = Seller::where('user_id',$user->id)->first();
            if($data != null){
              if($data->image != null){
                $image = 'sellers/'.$data->image;
                Storage::delete($image);
              }
              $orders = Order::where('seller_id',$data->id)->get();
              foreach($orders as $order){
                $order->delete();
              }
              $offers = Offer::where('seller_id',$data->id)->get();
              foreach($offers as $offer){
                $offer->delete();
              }
              $products = Product::where('seller_id',$data->id)->get();
              foreach($products as $product){
                if($product->image !=null){
                  $image = 'products/'.$product->image;
                  Storage::delete($image);
                }
                $product->delete();
              }
              $data->contact()->delete();
              $data->delete();
            }
          }else{
            $data = Customer::where('user_id',$user->id)->first();
            if($data != null){
              if($data->image != null){
                $image = 'customers/'.$data->image;
                Storage::delete($image);
              }
              $data->contact()->delete();
              $offers = Offer::where('customer_id',$data->id)->get();
              foreach($offers as $offer){
                $offer->delete();
              }
              $orders = Order::where('customer_id',$data->id)->get();
              foreach($orders as $order){
                $order->delete();
              }
              $data->delete();
            }
          }
          $user->delete();
          return redirect()->route('allusers');
      }
    }

    public function allproducts()
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $products = Product::orderBy('id','desc')->paginate(6);
        return view('admin.allproducts')->withProducts($products);
      }
    }

    public function productinfo(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $product = Product::where('id',$request->product_id)->first();
        return view('admin.productinfo')->withProduct($product);
      }
    }

    public function productdelete(Request $request)
    {
      if(Auth::user()->role != 'admin'){
          return view('layouts.error');
      }else{
        $product = Product::find($request->product_id);
        if($product->image != null){
          $image = 'products/'.$product->image;
          Storage::delete($image);
        }
        $orders = Order::where('products_id',$product->id)->get();
        foreach($orders as $order){
            $order->delete();
        }
        $product->delete();
        return redirect()->route('allproducts');
      }
    }
}

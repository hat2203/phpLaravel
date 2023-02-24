<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class WebController extends Controller
{
    public function home(){
        $products = Product::limit(8)->orderBy("id","desc")->get();
        $categories = Category::limit(10)->orderBy("id","desc")->get();
        return view("home",compact("products","categories"));
    }

    public function detail(Product $product){
        $related_product = Product::CategoryFilter($product->category_id)
            ->where("id","!=",$product->id)
            ->get()->random(4);
        $best_seller_ids = DB::table("orders_products")->groupBy("product_id")
                            ->orderBy("sum_qty","desc")->limit(4)
                            ->select(DB::raw("product_id, sum(qty) as sum_qty"))
                            ->get()->pluck("product_id")->toArray();
        $best_sellers = Product::find($best_seller_ids);
        return view("user.product.detail",compact("product","related_product","best_sellers"));
    }

    public function addToCart(Product $product,Request $request){
        $request->validate([
           "qty"=>"required|numeric|min:1"
        ]);
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        $flag = true;
        foreach ($cart as $item){
            if($item->id == $product->id){
                $item->buy_qty += $request->get("qty");
                $flag = false;
                break;
            }
        }
        if($flag){
            $product ->buy_qty = $request->get("qty");
            $cart[] = $product;
        }
        session(["cart"=>$cart]);
        return redirect()->back();
    }

    public function shop_cart(Product $product, Request $request){

        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        $grand_total = 0;
        $can_checkout = true;
        foreach ($cart as $item){
            $grand_total += $item->price * $item->buy_qty;
            if($can_checkout && $item->qty ==0){
                $can_checkout =  false;
            }
        }
        return view("user.product.cart",compact("cart","grand_total",'can_checkout'));
    }

    public function checkout(){
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        if(count($cart) == 0){
            return redirect()->to("/cart");
        }
        $grand_total = 0;
        foreach ($cart as $item){
            $grand_total += $item->price * $item->buy_qty;
        }
        return view("user.product.checkout",compact('cart',"grand_total"));
    }

    public function createOrder(Request $request){
        $request->validate([
            "fist_name"=>"required",
            "last_name"=>"required",
            "country"=>"required",
            "shipping_address"=>"required",
            "post_code"=>"required",
            "customer_tel"=>"required",
            "customer_email"=>"required",
        ]);

        try {
            $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
            if (count($cart)==0)return abort(404);
            $grand_total = 0;
            $can_checkout = true;
            foreach ($cart as $item){
                $grand_total += $item->price * $item->buy_qty;
                if($can_checkout && $item->qty ==0){
                    $can_checkout =  false;
                }
            }
            if (!$can_checkout) return abort(404);
            $order= Order::create([
                "order_date"=>now(),
                "grand_total"=>$grand_total,
                "fist_name"=>$request->get("fist_name"),
                "last_name"=>$request->get("last_name"),
                "country"=>$request->get("country"),
                "shipping_address"=>$request->get("shipping_address"),
                "post_code"=>$request->get("post_code"),
                "customer_tel"=>$request->get("customer_tel"),
                "customer_email"=>$request->get("customer_email")
            ])->createItem();

            return redirect()->to("/");
        }catch (Exception $e){
            return redirect()->back();
        }
    }

    public function remove(Product $product){
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        foreach ($cart as $key=>$item){
            if($item->id == $product->id){
                unset($cart[$key]);
                break;
            }
        }
        session(["cart"=>$cart]);
        return redirect()->back();
    }

    public function aboutUs(){
        return view("about_us");
    }
    //
}

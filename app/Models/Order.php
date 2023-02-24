<?php

namespace App\Models;

use App\Events\NewOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailOrder;
use Pusher\Pusher;

class Order extends Model
{

    use HasFactory;
    protected $table = "orders";

    protected $fillable = [
       "order_date",
       "grand_total",
        "fist_name",
        "last_name",
        "country",
       "shipping_address",
        "post_code",
       "customer_tel",
        "customer_email",
       "status"
    ];

    public function Products(){
//        return $this->belongsToMany(Product::class,
//            "orders_products","order_id","product_id","id","id");
        return $this->belongsToMany(Product::class,
            "orders_products");
    }

    public function createItem(){
        $cart = session()->has("cart") && is_array(session("cart"))?session("cart"):[];
        foreach ($cart as $item){
            DB::table("orders_products")->insert([
                "qty"=>$item->buy_qty,
                "price"=>$item->price,
                "order_id"=>$this->id,
                "product_id"=>$item->id
            ]);
        }

       //noi can phat su kien
        event(new NewOrder($this));
    }
}

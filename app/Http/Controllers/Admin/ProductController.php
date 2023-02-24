<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function listAll(Request $request){
        $search = $request->get("search");
        $category_id = $request->get("category_id");

        $data = Product::with("Category")
            ->Search($search)
            ->CategoryFilter($category_id)
            ->where("name","like","%$search%")
            ->orderBy("id","asc")
            ->paginate(20);

        $categories = Category::all();
        return view("admin.product.list",[
            "data"=>$data,
            "categories"=>$categories
        ]);
    }


//    public function listAll(){
////        $data = Product::where("price",">",500)
////            ->where("qty","<",20)
//////            ->orWhere("status",true)
//////            ->orWhere("name","like","%a%")
//////            ->whereMonth("created_at","=",3)
////            ->orderBy("id","asc")->paginate(20);
//
////        $data = Product::leftJoin("categories","categories.id","=","products.category_id")
////            ->select(["product.*","categories.name as category_name"])
////            ->orderBy("id","asc")->paginate(20);
//
//          $data = Product::with("Category")
////              ->where("price",">",500)
////            ->where("qty","<",20)
//            ->orderBy("id","asc")
//            ->paginate(20);
//
//        return view("admin.product.list",[
//            "data"=>$data
//        ]);
//    }

//    public function listAll(){
////        $data = Product::all(); //colection product object
//        // offset = (page - 1)*limit
////        $data = Product::limit(20)->offset(20)->get();
////        $data = Product::limit(20)->orderBy("id","asc")->get();//sap xep
//        $data = Product::orderBy("id","asc")->paginate(20);//paginate tra ve mot dang phan trang san trong lavarel
////        return view("admin.product.list",compact("data")); cach so 1
//        return view("admin.product.list",[
//            "data"=>$data
//        ]);
//    }

    public function createForm(){
        $categories = Category::all();
        return view("admin.product.createProduct",compact("categories"));
    }
    public function store(Request $request){
        $request->validate([
            "name"=>"required|string|min:6",
            "price"=>"required|numeric|min:0",
            "qty"=>"required|numeric|min:0",
            "category_id"=>"required",
            "thumbnail"=>"required|image|mimes:jpg,png,jpeg,gif"
        ],[
            "required"=>"Vui lòng nhập thông tin",
            "string"=> "Phải nhập vào là một chuỗi văn bản",
            "min"=> "Phải nhập :attribute  tối thiểu :min",
            "mimes"=>"Vui lòng nhập đúng định dạng ảnh"
        ]);

        try {
            $thumbnail = null;
            if($request->hasFile("thumbnail")){
                $file = $request->file("thumbnail");
                $fileName = time().$file->getClientOriginalName();
//            $ext = $file->getClientOriginalExtension();
//            $fileName = time().".".$ext;
                $path = public_path("uploads");
                $file->move($path,$fileName);
                $thumbnail = "uploads/".$fileName;
            }

            $product = Product::create([
                "name"=>$request->get("name"),
                "price"=>$request->get("price"),
                "thumbnail"=>$thumbnail,
                "description"=>$request->get("description"),
                "qty"=>$request->get("qty"),
                "category_id"=>$request->get("category_id"),
            ]);
            return redirect()->to("/admin/product")->with("success","Thêm sản phẩm thành công");
        }catch (Exception $e){
            return redirect()->back()->with("error",$e->getMessage());
        }


    }

    public function editForm(Product $product){
       // $product = Product::findOrFail($id);
        $categories = Category::all();
        return view("admin.product.edit",compact("categories",'product'));
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            "name"=>"required|string|min:6",
            "price"=>"required|numeric|min:0",
            "qty"=>"required|numeric|min:0",
            "category_id"=>"required",
            "thumbnail"=>"nullable|image|mimes:jpg,png,jpeg,gif"
        ],[
            "required"=>"Vui lòng nhập thông tin",
            "string"=> "Phải nhập vào là một chuỗi văn bản",
            "min"=> "Phải nhập :attribute  tối thiểu :min",
            "mimes"=>"Vui lòng nhập đúng định dạng ảnh"
        ]);

        $thumbnail = $product->thumbnail;
        if($request->hasFile("thumbnail")){
            $file = $request->file("thumbnail");
            $fileName = time().$file->getClientOriginalName();
            $path = public_path("uploads");
            $file->move($path,$fileName);
            $thumbnail = "uploads/".$fileName;
        }

        $product->update([
            "name"=>$request->get("name"),
            "price"=>$request->get("price"),
            "thumbnail"=>$thumbnail,
            "description"=>$request->get("description"),
            "qty"=>$request->get("qty"),
            "category_id"=>$request->get("category_id"),
        ]);
        return redirect()->to("/admin/product");
    }

    public function delete(Product $product){
        $product->delete();
        return redirect()->to("admin/product");
    }
}

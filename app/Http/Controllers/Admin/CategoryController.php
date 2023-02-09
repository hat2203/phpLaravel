<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function caList(){
        $data = Category::orderBy("id","asc")->paginate(20);
        return view("admin.category.listCategories",
            [
                "data"=>$data
            ]
        );
    }

    public function caCreate(){
        $category = Category::all();
        return view("admin.category.createCategory", compact("category"));
    }

    public function caSave(Request $request){
        $data = $request->all();
        Category::create($data);
        return redirect()->to("/admin/category");
    }
}

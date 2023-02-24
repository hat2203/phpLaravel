<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function listStudent(){
        $data = Student::orderBy("id","asc")->paginate(20);
        return view("students.studentList",[
            "data"=>$data
        ]);
    }

    public function createStudent(){
        $student = Student::all();
        return view("students.createStudent",compact($student));
    }

    public function saveStudent(Request $request){
        $request->validate([
            "name"=>"required|string|min:2",
            "age"=>"required|numeric|min:18|max:50",
            "address"=>"required|string|min:2",
            "telephone"=>"required|string|min:9"
        ],[
           "required"=>"vui lòng nhập thông tin",
            "string"=>"Phải nhập vào là một chuỗi văn bản",
            "min"=>"Phải nhập tối thiểu :min :doituong",
            "max"=>"Chỉ được nhập tối đa :max :doituong"
        ]);

        try{
            $student = Student::create([
                "name"=>$request->get("name"),
                "age"=>$request->get("age"),
                "address"=>$request->get("address"),
                "telephone"=>$request->get("telephone")
            ]);
            return redirect()->to("//studentList");
        }catch (Exception $e ){
            return redirect()->back();
        }

    }
}

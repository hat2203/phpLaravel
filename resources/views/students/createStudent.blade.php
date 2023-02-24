<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ url("/") }}"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    @include("admin.html.css")
    @yield("custom_css")
</head>
<body>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Student information</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{url("/createStudent")}}" role="form" enctype="multipart/form-data" >
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Student Name</label>
                <input type="text" name="name" class="form-control" required >
            </div>
            <div class="form-group">
                <label>Student Age</label>
                <input type="number" min="18" max="50" name="age" class="form-control" required >
            </div>
            <div class="form-group">
                <label>Student Address</label>
                <input type="text" name="address" class="form-control" required >
            </div>
            <div class="form-group">
                <label>Student Telephone</label>
                <input type="text" name="telephone" class="form-control" required >
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@include('admin.html.js')
@yield("custom_js")
{{--@endsection--}}
</body>




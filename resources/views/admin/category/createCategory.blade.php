@extends('admin.layout')
@section('title','Thêm mới sản phẩm')
@section("custom_css")
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section("custom_js")
    <script src="/admin/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
@section('content_header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create a new product</h1>
    </div>

@endsection
@section('content_section')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Product information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{url("/admin/category/create")}}" role="form" >
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Category Image</label>
                    <input type="text" name="image" class="form-control">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

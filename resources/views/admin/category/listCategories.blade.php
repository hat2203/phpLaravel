@extends('admin.layout')
@section('title','Trang quản trị nội dung')
@section('content_header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Categories</h1>
    </div><!-- /.col -->
    <div class="col-sm-6 text-right">
        <a class="btn btn-outline-primary" href="{{url("/admin/category/create")}}">Create a new Category</a>
    </div>
@endsection

@section('content_section')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bordered Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th style="width: 40px">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td><img width="75px" src="{{$item->image}}"/></td>
                        <td>
                            @if($item->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-warning">Inactive</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{--            <ul class="pagination pagination-sm m-0 float-right">--}}
            {{--                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>--}}
            {{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
            {{--                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
            {{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
            {{--                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>--}}
            {{--            </ul>--}}
            {!! $data->links("pagination::bootstrap-4") !!}
        </div>
    </div>
@endsection


@extends('admin.layouts.app')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title"></h5>
                                <a class="btn btn-success" href="{{route('category.create')}}">Thêm Category</a>
                            </div>
                            @if(count($listData) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">...</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($listData as $key => $value)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$value->title}}</td>
                                            <td>
                                                <img src="{{asset($value->img)}}" width="100px" height="100px" style="object-fit: contain">
                                            </td>
                                            <td>
                                                @if($value->display == 1)
                                                    Bật
                                                @else
                                                    Tắt
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{url('category/edit/'.$value->id)}}" class="btn btn-warning" >
                                                        Sửa
                                                    </a>
                                                    <a href="{{url('category/delete/'.$value->id)}}" class="btn btn-danger ml-3" >
                                                         Xóa
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                            </div>
                            @else
                                <h5 class="card-title">Không có dữ liệu</h5>
                         @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>

    </script>
@endsection

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
                                <a class="btn btn-success" href="{{route('products.create')}}">Thêm Sản phẩm</a>
                            </div>
                            @if(count($products) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->price) }} VND</td>
                                            <td>
                                                <img src="{{ $item->thumb }}" width="100px" height="100px" alt="">
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Sửa</a>
                                                <button data-id="{{ $item->id }}" data-url="{{ route('products.destroy', $item->id) }}"
                                                        id="btnDelete" class="btn btn-danger">Xoá</button>
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
@push('js')
    <script src="{{ asset('admin/products/js/main.js') }}"></script>
@endpush

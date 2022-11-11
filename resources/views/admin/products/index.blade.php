@extends('admin.layouts.app')

@section('content')
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <button class="btn btn-link"><a href="{{ route('products.create') }}">Thêm Sản phẩm</a></button>
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
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
                @foreach ($products as $item)
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
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/products/js/main.js') }}"></script>
@endpush

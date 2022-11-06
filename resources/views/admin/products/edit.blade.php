@extends('admin.layouts.app')

@section('content')
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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
        <form method="POST" action="{{route('products.update',$product->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm</label>
                <input value="{{$product->name}}" name="name" type="text" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mô tả</label>
                <input value="{{$product->description}}" name="description" type="text" class="form-control"
                       id="exampleInputPassword1"
                       placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nội dung</label>
                <textarea name="content" class="form-control" id="exampleInputPassword1">
                    {{$product->content}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Danh mục</label>
                <select name="category_id" id="" class="form-control">
                    <option
{{--                        {{$item->category_id === $category->id ? 'selected' : ''}}--}}
                        value="1">Dell
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Giá</label>
                <input value="{{$product->price}}" name="price" type="number" class="form-control"
                       id="exampleInputPassword1" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInput1">Giá Khuyến mãi</label>
                <input value="{{$product->price_sale}}" name="price_sale" type="number" class="form-control"
                       id="exampleInput1" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" id="upload" placeholder="">
                <div id="image_show">
                    <img src="{{$product->thumb}}" width="300px" height="300px" alt="">
                </div>
                <input type="hidden" value="{{$product->thumb}}" name="thumb" id="file">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Kích hoạt</label>
                <div class="">
                    <input {{$product->active === 1 ? 'checked' : ''}} type="radio" value="1" id="active" name="active"
                           aria-label="Checkbox for following text input">
                    <label for="active">Có</label>
                </div>
                <div class="">
                    <input {{$product->active === 0 ? 'checked' : ''}} type="radio" value="0" id="no_active"
                           name="active"
                           aria-label="Checkbox for following text input">
                    <label for="no_active">Không</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/products/js/main.js') }}"></script>
@endpush

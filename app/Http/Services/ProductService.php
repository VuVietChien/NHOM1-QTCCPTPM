<?php


namespace App\Http\Services;


use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductService
{
    protected function isValidPrice($request)
    {
        if ($request->get('price') > 0 && $request->get('price_sale') > 0 && $request->get('price_sale') > $request->get('price')) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if ($request->get('price_sale') > 0 && is_null($request->get('price'))) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }
    }
    public function get(){
        return Product::query()->latest()->paginate(5);
    }
    public function insert($request)
    {
//        $isValidPrice = $this->isValidPrice($request);
//        if (!$isValidPrice) {
//            return false;
//        }
        try {
            $request->except('_token');
            Product::query()->create($request->all());
            Session::flash('success', 'Thêm thành công');
        } catch (\Exception $exception) {
            Session::flash('error', 'Thêm thất bại');
            Log::info($exception->getMessage());
            return false;
        }
        return true;
    }
    public function update($request,$id){
        try {
            $request->except('_token');
            Product::query()->find($id)->update($request->all());
            Session::flash('success', 'Sửa thành công');
        } catch (\Exception $exception) {
            Session::flash('error', 'Sửa thất bại');
            Log::info($exception->getMessage());
            return false;
        }
        return true;
    }
}

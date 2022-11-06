<?php

namespace App\Http\Controllers;

use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index ()
    {
        $listData = SliderModel::orderBy('created_at', 'desc')->get();
        return view('admin.slider.index', compact('listData'));
    }

    public function create ()
    {
        return view('admin.slider.create');
    }

    public function store (Request $request)
    {
        try{
            if (!$request->hasFile('img')){
                return back()->with(['error' => 'Vui lòng thêm hình ảnh Slider']);
            }

            $file = $request->file('img');
            $file_name = 'upload/'.Str::random(40).'.'.$file->getClientOriginalExtension();
            $file->move('upload/', $file_name);
            $slider = new SliderModel([
                'title' => $request->get('title'),
                'img' => $file_name,
                'display' => $request->get('display')
            ]);
            $slider->save();
            return redirect()->route('slider.index')->with(['success' => 'Thêm mới Slider thành công']);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }

    public function delete ($id)
    {
        $slider = SliderModel::find($id);
        if (empty($slider)){
            return back()->with(['error' => 'Slider không tồn tại']);
        }
        unlink($slider->img);
        $slider->delete();
        return back();
    }

    public function edit ($id)
    {
        $slider = SliderModel::find($id);
        if (empty($slider)){
            return back()->with(['error' => 'Slider không tồn tại']);
        }
        return view('admin.slider.edit', compact( 'slider'));
    }

    public function update (Request $request, $id)
    {
        try{
            $blog = SliderModel::find($id);
            if (empty($blog)){
                return back()->with(['error' => 'Slider không tồn tại']);
            }
            if ($request->hasFile('img')){
                $file = $request->file('img');
                $file_name = 'upload/'.Str::random(40).'.'.$file->getClientOriginalExtension();
                $file->move('upload/', $file_name);
                unlink($blog->img);
                $blog->img = $file_name;
            }
            $blog->title = $request->get('title');
            $blog->display = $request->get('display');
            $blog->save();
            return redirect()->route('slider.index')->with(['success' => 'Cập nhật slider thành công']);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }
}

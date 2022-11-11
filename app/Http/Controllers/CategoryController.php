<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index ()
    {
        $listData = CategoryModel::orderBy('created_at', 'desc')->get();
        return view('admin.category.index', compact('listData'));
    }

    public function create ()
    {
        return view('admin.category.create');
    }

    public function store (Request $request)
    {
        try{
            if (!$request->hasFile('img')){
                return back()->with(['error' => 'Vui lòng thêm hình ảnh Category']);
            }

            $file = $request->file('img');
            $file_name = 'upload/'.Str::random(40).'.'.$file->getClientOriginalExtension();
            $file->move('upload/', $file_name);
            $category = new CategoryModel([
                'title' => $request->get('title'),
                'img' => $file_name,
                'display' => $request->get('display')
            ]);
            $category->save();
            return redirect()->route('category.index')->with(['success' => 'Thêm mới Category thành công']);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }

    public function delete ($id)
    {
        $category = CategoryModel::find($id);
        if (empty($category)){
            return back()->with(['error' => 'Category không tồn tại']);
        }
        unlink($category->img);
        $category->delete();
        return back();
    }

    public function edit ($id)
    {
        $category = CategoryModel::find($id);
        if (empty($category)){
            return back()->with(['error' => 'Bài viết không tồn tại']);
        }
        return view('admin.category.edit', compact( 'category'));
    }

    public function update (Request $request, $id)
    {
        try{
            $category = CategoryModel::find($id);
            if (empty($category)){
                return back()->with(['error' => 'Bài viết không tồn tại']);
            }
            if ($request->hasFile('img')){
                $file = $request->file('img');
                $file_name = 'upload/'.Str::random(40).'.'.$file->getClientOriginalExtension();
                $file->move('upload/', $file_name);
                unlink($category->img);
                $category->img = $file_name;
            }
            $category->title = $request->get('title');
            $category->display = $request->get('display');
            $category->save();
            return redirect()->route('category.index')->with(['success' => 'Cập nhật category thành công']);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }
}

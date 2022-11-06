<?php

namespace App\Http\Controllers;

use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index ()
    {
        $listData = NewsModel::orderBy('created_at', 'desc')->get();
        return view('admin.news.index', compact('listData'));
    }

    public function create ()
    {
        return view('admin.news.create');
    }

    public function store (Request $request)
    {
        try{
            if (!$request->hasFile('img')){
                return back()->with(['error' => 'Vui lòng thêm hình ảnh news']);
            }

            $file = $request->file('img');
            $file_name = 'upload/'.Str::random(40).'.'.$file->getClientOriginalExtension();
            $file->move('upload/', $file_name);
            $news = new NewsModel([
                'title' => $request->get('title'),
                'img' => $file_name,
                'content' => $request->get('content'),
                'display' => $request->get('display')
            ]);
            $news->save();
            return redirect()->route('news.index')->with(['success' => 'Thêm mới news thành công']);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }

    public function delete ($id)
    {
        $news = NewsModel::find($id);
        if (empty($news)){
            return back()->with(['error' => 'Category không tồn tại']);
        }
        unlink($news->img);
        $news->delete();
        return back();
    }

    public function edit ($id)
    {
        $news = NewsModel::find($id);
        if (empty($news)){
            return back()->with(['error' => 'Bài viết không tồn tại']);
        }
        return view('admin.news.edit', compact( 'news'));
    }

    public function update (Request $request, $id)
    {
        try{
            $news = NewsModel::find($id);
            if (empty($news)){
                return back()->with(['error' => 'Bài viết không tồn tại']);
            }
            if ($request->hasFile('img')){
                $file = $request->file('img');
                $file_name = 'upload/'.Str::random(40).'.'.$file->getClientOriginalExtension();
                $file->move('upload/', $file_name);
                unlink($news->img);
                $news->img = $file_name;
            }
            $news->title = $request->get('title');
            $news->content = $request->get('content');
            $news->display = $request->get('display');
            $news->save();
            return redirect()->route('news.index')->with(['success' => 'Cập nhật news thành công']);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }
}

<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function store($request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = $file->getClientOriginalName();
                $pathFull = 'uploads';
                $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
            }
            return '/storage/' . $pathFull . '/' . $name;
        } catch (\Exception $e) {
            return false;
        }
    }
}

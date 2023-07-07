<?php

namespace App\Services;

class FileService
{
    public function getPath(mixed $request): string
    {
        $filename = $request->file('image')->getClientOriginalName();
        return $request->file('image')->storeAs('/assets/images', $filename, 'public');
    }
}

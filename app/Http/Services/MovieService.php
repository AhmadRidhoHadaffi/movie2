<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MovieService
{
    public function createMovie($data, $file)
    {
        $randomName = Str::uuid()->toString();
        $fileName = $randomName . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images'), $fileName);

        $data['foto_sampul'] = $fileName;

        return Movie::create($data);
    }
}
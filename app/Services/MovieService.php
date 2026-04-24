<?php

namespace App\Services;

use App\Interfaces\MovieRepositoryInterface;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MovieService
{
    protected $movieRepo;

    public function __construct(MovieRepositoryInterface $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    public function createMovie($data, $file)
    {
        $randomName = Str::uuid()->toString();
        $fileName = $randomName . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images'), $fileName);

        $data['foto_sampul'] = $fileName;

        return $this->movieRepo->create($data);
    }
}
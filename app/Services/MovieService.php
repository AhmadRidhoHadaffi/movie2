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

    public function getMovies($search)
    {
        return $this->movieRepo->getAll($search);
    }

    public function getMovie($id)
    {
        return $this->movieRepo->find($id);
    }

    public function updateMovie($id, $data, $file = null)
    {
        $movie = $this->movieRepo->find($id);

        if ($file) {
            // hapus file lama
            $path = public_path('images/' . $movie->foto_sampul);
            if (File::exists($path)) {
                File::delete($path);
            }

            // upload baru
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);

            $data['foto_sampul'] = $fileName;
        }

        return $this->movieRepo->update($id, $data);
    }

    public function deleteMovie($id)
    {
        $movie = $this->movieRepo->find($id);

        $path = public_path('images/' . $movie->foto_sampul);
        if (File::exists($path)) {
            File::delete($path);
        }

        return $this->movieRepo->delete($id);
    }
}
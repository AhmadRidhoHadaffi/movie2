<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAll($search = null)
    {
        $query = Movie::latest();

        if ($search) {
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('sinopsis', 'like', "%$search%");
        }

        return $query->paginate(6);
    }

    public function find($id)
    {
        return Movie::findOrFail($id);
    }

    public function create($data)
    {
        return Movie::create($data);
    }

    public function update($id, $data)
    {
        $movie = $this->find($id);
        $movie->update($data);
        return $movie;
    }

    public function delete($id)
    {
        $movie = $this->find($id);
        return $movie->delete();
    }
}
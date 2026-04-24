<?php

namespace App\Interfaces;

interface MovieRepositoryInterface
{
    public function getAll($search = null);
    public function find($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
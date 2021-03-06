<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait BaseRepository
{
    /**
     * Get all records
     * @return Collection|null
     */
    public function getAll(): ?Collection
    {
        return $this->model->all();
    }

    /**
     * Find record by ID
     * @param string $id
     * @return Model|null
     */
    public function find(string $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Get last records
     * @return Model|null
     */
    public function getLast(): Model|null
    {
        return $this->model->orderByDesc('id')->first();
    }
}

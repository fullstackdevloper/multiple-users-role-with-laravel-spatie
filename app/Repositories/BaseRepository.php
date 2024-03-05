<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new record in the database for the specified model.
     *
     * @param  array  $data Data to be used for creating the record.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Retrieve all records for the specified model.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retrieve all records for the specified model with condition.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
     */
    public function get(array $conditions = [], array $relations = [])
    {
        $query = $this->model;

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->get();
    }

    /**
     * Retrieve paginate records for the specified model with condition.
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection
     */
    public function paginate($perPage = 10, array $conditions = [], array $relations = [])
    {
        $query = $this->model->where($conditions);

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->paginate($perPage);
    }

    /**
     * Find a model by id
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }


    /**
     * Find a model by specified uuid.
     *
     * @param  string  $uuid
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUuid(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    /**
     * Update a model based on specified criteria.
     *
     * @param  array  $criteria
     * @param  array  $updateData
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateByCriteria(array $criteria, array $updateData)
    {
        $model = $this->model->where($criteria)->first();

        if ($model) {
            if ($model->update($updateData)) {
                return $model;
            }
        }

        return false;
    }

    /**
     * Update or create a model based on specified criteria.
     *
     * @param  array  $criteria
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreateByCriteria(array $criteria, array $attributes)
    {
        return $this->model->updateOrCreate($criteria, $attributes);
    }

    /**
     * Delete a record by its ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * Delete a record by its UUID.
     *
     * @param  string  $id
     * @return bool
     */
    public function deleteByUuid(string $uuid): bool
    {
        return $this->model->where('uuid', $uuid)->delete();
    }

    /**
     * Delete a record using condition.
     *
     * @param  string  $id
     * @return bool
     */
    public function deleteUsingArray(string $column, array $values): bool
    {
        return $this->model->whereIn($column, $values)->delete();
    }
}

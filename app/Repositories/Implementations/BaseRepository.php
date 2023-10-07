<?php


namespace App\Repositories\Implementations;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Interfaces\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById(int $id, array $columns = ['*'], array $relations = []): Model
    {
        return $this->findByCriteria(['id' => $id], $columns, $relations);
    }

    public function findByUuid(string $uuid, array $columns = ['*'], array $relations = []): Model
    {
        return $this->findByCriteria(['uuid' => $uuid], $columns, $relations);
    }

    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Model
    {
        return $this->newQuery()->select($columns)->with($relations)->where($criteria)->firstOrFail();
    }

    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->newQuery()->select($columns)->with($relations)->where($criteria)->get();
    }

    public function create(array $attributes): Model
    {
        return $this->newQuery()->create($attributes);
    }

    public function update(Model $model, array $attributes): void
    {
        $model->update($attributes);
    }

    public function delete(Model $model): void
    {
        $model->delete();
    }

    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }
}

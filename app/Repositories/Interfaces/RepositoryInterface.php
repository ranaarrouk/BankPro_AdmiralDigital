<?php


namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface RepositoryInterface
{
    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): Model;

    /**
     * @param string $uuid
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findByUuid(string $uuid, array $columns = ['*'], array $relations = []): Model;

    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Model;

    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection;


    public function whereOrWhere(array $conditions, array $columns = ['*'], array $relations = [], bool $orWhere = false): Collection;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param Model $model
     * @param array $attributes
     * @return void
     */
    public function update(Model $model, array $attributes): void;

    public function delete(Model $model): void;

    /**
     * @return Builder
     */
    public function newQuery(): Builder;
}

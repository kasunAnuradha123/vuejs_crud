<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Bool_;

interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     *
     * @param  array  $columns
     * @param  array  $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;
    /**
     * @param int $limit
     * @param array $columns
     * @param array $relations
     * 
     * @return Collection
     */
    public function limit(int $limit, array $columns = ['*'], array $relations = []): Collection;
    /**
     * @param int $number
     * 
     * @return [type]
     */
    public function paginate(int $number);
    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection;

    /**
     * Find model by id.
     *
     * @param  int  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Model
     */
    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    /**
     * Find model by id.
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Model
     */
    public function findByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;
    /**
     * Find model by columns.
     *
     * @param  array  $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @param  array  $appends
     * @return Collection
     */
    public function getByColumn(
        array $paramsAnddData,
        array $columns = ['*'],
        array $relations = []
    ): ?Collection;
    /**
     * @param int $limit
     * @param array $columns
     * @param array $relations
     * 
     * @return Collection
     */
    public function getRandom(int $limit,array $idNotIn, array $columns = ['*'], array $relations = []): ?Collection;
   
    /**
     * @param array $params
     * @param array $columns
     * 
     * @return bool|null
     */
    public function existsByColumn(array $params): ?bool;
    /**
     * Find trashed model by id.
     *
     * @param  int  $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model;

    /**
     * Find only trashed model by id.
     *
     * @param  int  $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model;

    /**
     * Create a model.
     *
     * @param  array  $payload
     * @return Model
     */
    public function create(array $payload): ?Model;

    /**
     * @param array $payload
     * 
     * @return Collection|null
     */
    public function createMany(array $payload): ?Collection;

    /**
     * Update existing model.
     *
     * @param  int  $modelId
     * @param  array  $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool;

    /**
     * Update existing model.
     *
     * @param  int  $modelId
     * @param  array  $payload
     * @return bool
     */
    public function updateWithMeta(int $modelId, array $payload): bool;

    /**
     * @param int $modelId
     * @param array $payload
     *
     * @return bool
     */
    public function updateWithTrashed(int $modelId, array $payload): bool;
    /**
     * Delete model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * @param array $params
     * 
     * @return bool
     */
    public function deleteByColumn(array $params): bool;

    /**
     * Restore model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool;

    /**
     * Permanently delete model by id.
     *
     * @param  int  $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool;

    
    /**
     * Method filter
     *
     * @param array $request [Http Request]
     * @param array $with [Relations]
     *
     * @return LengthAwarePaginator
     */
    public function filter($filters, $with = []): LengthAwarePaginator;

    /**
     * @param string $column
     * @param array $columns
     * @param array $relations
     * 
     * @return Model|null
     */
    public function findLast(string $column, array $columns = ['*'], array $relations = []): ?Model;
}

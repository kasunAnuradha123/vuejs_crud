<?php

namespace App\Repositories\Eloquent\Users;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function userFilter($filters, $roles=[] ,$with = []): LengthAwarePaginator
    {
        $query = $this->model->filter($filters)->orderByColumn($filters['sortBy'], $filters['sortDirection']);
        if (count($with) > 0) {
            $query = $query->with($with);
        }
        if ($filters['status'] == 'all') {
            $query = $query->whereIn('role_id' ,$roles)->with($with);
        } else {
            $query = $query->whereIn('role_id', $roles)->where('status', $filters['status']);
        }
        return $query->Where('status', "!=", "draft")->paginate($filters['rowPerPage'])->appends($filters);
    }
}

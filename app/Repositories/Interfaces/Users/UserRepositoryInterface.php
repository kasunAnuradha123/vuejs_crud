<?php

namespace App\Repositories\Interfaces\Users;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function userFilter($filters, $roles=[], $with = []): LengthAwarePaginator;
}

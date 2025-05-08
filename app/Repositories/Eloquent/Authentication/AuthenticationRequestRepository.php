<?php

namespace App\Repositories\Eloquent\Authentication;

use App\Models\AuthenticationRequest;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Authentication\AuthenticationRequestRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthenticationRequestRepository extends BaseRepository implements AuthenticationRequestRepositoryInterface
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
    public function __construct(AuthenticationRequest $model)
    {
        $this->model = $model;
    }

  
}

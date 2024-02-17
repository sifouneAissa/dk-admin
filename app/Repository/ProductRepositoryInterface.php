<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface ProductRepositoryInterface extends EloquentRepositoryInterface
{

    public function list($data,$useResource = false,$useResponse = false,$usePaginate = true);
}

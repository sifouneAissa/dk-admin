<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface CategoryRepositoryInterface extends EloquentRepositoryInterface
{

    public function list($data,$useResource = false,$useResponse = false,$usePaginate = true);

    public function store($data,$useResource =false);
    public function update($data,Category $product,$useResource =false);
    public function destroy($data,Category $product,$useResource =false);
}

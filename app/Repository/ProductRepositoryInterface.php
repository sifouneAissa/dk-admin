<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface ProductRepositoryInterface extends EloquentRepositoryInterface
{

    public function list($data,$useResource = false,$useResponse = false,$usePaginate = true);

    public function store($data,$useResource =false);
    public function update($data,Product $product,$useResource =false);
    public function destroy($data,Product $product,$useResource =false);
}

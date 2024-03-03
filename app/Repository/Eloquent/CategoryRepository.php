<?php

namespace App\Repository\Eloquent;

use App\Filters\EventFilter;
use App\Http\Resources\Category\CategoryResourceCollection;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }


    public function list($data, $useResource = false, $useResponce = false, $usePaginate = true)
    {

        $models = $this->model->orderBy('created_at', 'desc');

        $result = (new EventFilter($data))->applyFilter($models);

        if (!$result) {
            if ($usePaginate)
                $models = $models->paginate($this->perPage());
            else $models = $models->get();
        } else {
            $models = $result;
        }

        if ($useResponce)
            $models = CategoryResourceCollection::make($models);
        if ($useResource)
            $models = $this->response($models);

        return $models;
    }


    public function store($data, $useResource = false)
    {

        $data = $this->model->create($data);

        if ($useResource) {
            return ProductResource::make($data);
        }

        return $data;
    }

    public function update($data, Category $product, $useResource = false)
    {

        return $product->update(
            $data
        );
    }


    public function destroy($data,Category $product,$useResource =false){
        return $product->delete();
    }
}

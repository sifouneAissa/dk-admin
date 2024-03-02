<?php

namespace App\Repository\Eloquent;

use App\Filters\EventFilter;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
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
            $models = ProductCollectionResource::make($models);
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

    public function update($data, Product $product, $useResource = false)
    {

        return $product->update(
            $data
        );
    }


    public function destroy($data,Product $product,$useResource =false){
        return $product->delete();
    }
}

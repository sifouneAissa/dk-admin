<?php

namespace App\Repository\Eloquent;

use App\Http\Resources\Product\ProductCollectionResource;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function list($data,$useResource = false,$useResponce = false,$usePaginate = true){
        
        $models = $this->model;

        if($usePaginate)
        $models  = $this->model->paginate($this->perPage());
    
        if($useResponce)
            $models = ProductCollectionResource::make($models);
        if($useResource)
            $models = $this->response($models);

        return $models;
    }
   
}

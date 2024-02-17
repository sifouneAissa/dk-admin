<?php

namespace App\Http\Resources\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollectionResource extends ResourceCollection
{
    
    public function toArray(Request $request)
    {
         $this->resource->transform(function ($item){
            return ProductResource::make($item);
        });
        
        if($this->resource instanceof LengthAwarePaginator){
            ProductCollectionResource::$wrap = 'data';
        }
        else {
            ProductCollectionResource::$wrap = null;
        }

        return $this->resource;
    }
}

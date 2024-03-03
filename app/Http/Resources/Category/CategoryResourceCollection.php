<?php

namespace App\Http\Resources\Category;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
         $this->resource->transform(function ($item){
            return CategoryResource::make($item);
        });
        
        if($this->resource instanceof LengthAwarePaginator){
            CategoryResourceCollection::$wrap = 'data';
        }
        else {
            CategoryResourceCollection::$wrap = null;
        }

        return $this->resource;
    }
}

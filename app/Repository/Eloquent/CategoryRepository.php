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
        
        if(isset($data['forSelect']) && $data['forSelect']){
            return $this->getSelect();
        }

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


    public function getSelect(){
        return $this->getCategories(true);
    }
    

    public function getCategories($forSelect = false )
    {
        $rootCategories = Category::whereNull('parent_id')->get();
        $transformedCategories = [];

        foreach ($rootCategories as $rootCategory) {
            if(!$forSelect)
            $rootCategory->children = $this->getChildren($rootCategory);
            else
            $transformedCategories[] = $this->transformCategorySelect($rootCategory);
        }

        if(!$forSelect)
        return $rootCategories;

        return $transformedCategories;
    }

    protected function getChildren(Category $category)
    {
        $children = Category::where('parent_id', $category->id)->get();

        foreach ($children as $child) {
            $child->children = $this->getChildren($child);
        }

        return $children;
    }

    protected function transformCategorySelect(Category $category)
    {
        $transformedCategory = [
            'key' => $category->id,
            'label' => $category->name,
            'data' => $category->description,
            'icon' => 'pi pi-fw pi-inbox', // You can customize the icon based on your requirements
        ];

        $children = Category::where('parent_id', $category->id)->get();

        if ($children->isNotEmpty()) {
            $transformedCategory['children'] = [];
            foreach ($children as $child) {
                $transformedCategory['children'][] = $this->transformCategorySelect($child);
            }
        }

        return $transformedCategory;
    }
}

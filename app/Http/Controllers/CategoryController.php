<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\AddCategory;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    //
    private $repository;
    //
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return Inertia::render('Category', array_merge(
            buildBreadCrumb([
                'title' => 'Categories',
                'link' => route('admin.category.index')
            ]),
            $this->getConfig()
        ));
    }

    public function lindex(Request $request)
    {
        return $this->repository->list($request->all(), true, true);
    }


    public function create(Request $request)
    {
        return Inertia::render('Categories/Crud/Add', array_merge(
            buildBreadCrumb([
                'title' => 'Create Category',
                'link' => route('admin.category.create')
            ], [
                'title' => 'Categories',
                'link' => route('admin.category.index')
            ], false),
            $this->getConfig()
        ));
    }

    public function store(AddCategory $request){

        $result =  $this->repository->store($request->all());

        return redirect()->back()->with(
            'message' , 'Category added successfully'
        );
    }

    public function update(AddCategory $request,Category $category){
        
        $result =  $this->repository->update($request->all(),$category);

        return redirect()->back()->with(
            'message' , 'Category updated successfully'
        );
    }


    public function destroy(Request $request,Category $category){
        
        $result =  $this->repository->destroy($request->all(),$category);

        return redirect()->back()->with(
            'message' , 'Category deleted successfully'
        );
    }
    
    
    public function edit(Request $request,Category $category)
    {
        return Inertia::render('Categories/Crud/Edit', array_merge(
            buildBreadCrumb([
                'title' => 'Edit Category',
                'link' => route('admin.category.create')
            ], [
                'title' => 'Category',
                'link' => route('admin.category.index')
            ], false),
            $this->getConfig(),
            [
                'record' => CategoryResource::make($category)
            ]
        ));
    }
    
    public function getConfig()
    {
        return [
            'columns' => [
                [
                    'field' => 'name',
                    'header' => 'Name',
                ],
                [
                    'field' => 'description',
                    'header' => 'Description',
                ]
            ],
            'route' => route('admin.category.lindex')

        ];
    }
}

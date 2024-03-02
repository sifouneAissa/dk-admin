<?php

namespace App\Http\Controllers;

use App\Filters\EventFilter;
use App\Http\Requests\Product\AddProduct;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    private $repository;
    //
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return Inertia::render('Product', array_merge(
            buildBreadCrumb([
                'title' => 'Product',
                'link' => route('admin.product.index')
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
        return Inertia::render('Products/Crud/Add', array_merge(
            buildBreadCrumb([
                'title' => 'Create Product',
                'link' => route('admin.product.create')
            ], [
                'title' => 'Product',
                'link' => route('admin.product.index')
            ], false),
            $this->getConfig()
        ));
    }

    public function store(AddProduct $request){
        
        $result =  $this->repository->store($request->all());

        return redirect()->back()->with(
            'message' , 'Product added successfully'
        );
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
            'route' => route('admin.product.lindex')

        ];
    }
}

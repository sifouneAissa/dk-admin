<?php

namespace App\Http\Controllers;

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

    public function index(){
        
        return Inertia::render('Product',buildBreadCrumb([
            'title' => 'Product',
            'link' => route('admin.product')
        ]));
    }

    public function lindex(Request $request){
        return $this->repository->list($request->all(),true,true);
    }

}

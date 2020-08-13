<?php

namespace App\Http\Controllers\API;

use EloquentBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use Validator;

class ProductController extends BaseController
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(40);
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');
		}
		
		public function index(Request $request)
    {
        $users = EloquentBuilder::to(
                    Product::class,
                    $request->all()
                 );
        return $users->get();
    }
}

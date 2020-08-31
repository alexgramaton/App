<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Sub_category;
use Validator;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function index()
    {
        $categories = Category::all();
        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully.');
		}
		
		 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		//GET
    public function show($id)
    {
      $category = Category::find($id);
      if (is_null($category)) {
          return $this->sendError('Category not found.');
      }
      return $this->sendResponse($category->toArray(), 'Category retrieved successfully.');
		}
		
		/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function subCategories()
    {
			$categories = Category::all();
			$result = [
          'success' => true,
          'data'    => array(),
			];
			foreach ($categories as $category) {  
  			$result['data'][] = array(
    			'id' => $category->id,
    			'name' => $category->name,
					'subcategories' => $category->sub_categories()->orderBy('name', 'asc')
      		->get()
				);
			}
			return $this->sendResponse($result, 'Categories with subcategories retrieved successfully.');
		}
}

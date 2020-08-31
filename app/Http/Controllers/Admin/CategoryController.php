<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
		public function categories()
		{
			$categories = Category::all();
			return view('admin.categories')->with('categories',$categories);	
		}

		public function category(Request $request, $id)
		{
			$category = Category::findOrFail($id);
			return view('admin.category')->with('category',$category);;	
		}

		public function add(Request $request)
		{
			$category = Category::where('name', '=', $request->input('categoryName'))->first();
			if ($category === null) {
				$category = new Category;
				$category->name = $request->input('categoryName');
				$category->save();
				Session::flash('statuscode','success');
				return redirect('categories')->with('status','New category added');
			} else {
				Session::flash('statuscode','error');
				return redirect('categories')->with('status','Category already exists');
			}
		}

		public function update(Request $request, $id)
		{
			$category = Category::find($id);
			$category->name = $request->input('updateCategoryName');
			$category->update();
			Session::flash('statuscode','info');
			return redirect('categories')->with('status','Category is updated');
		}

		public function delete(Request $request, $id)
		{
			$category = Category::findOrFail($id);
			$category->delete();
			Session::flash('statuscode','error');
			return redirect('categories')->with('status','Category is deleted');
		}
}

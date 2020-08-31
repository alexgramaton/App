<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function subcategories()
		{
			$subcategories = Sub_category::all();
			$categories = Category::all();
			return view('admin.sub_categories')->with('subcategories',$subcategories)->with('categories',$categories);	
		}

		public function add(Request $request)
		{
			$subcategory = Sub_category::where('name', '=', $request->input('subCategoryName'))->first();
			if ($subcategory === null) {
				$subcategory = new Sub_category;
				$subcategory->name = $request->input('subCategoryName');
				if ($request->input('selCategory') != 0) {
					$subcategory->category_id = $request->input('selCategory');
				}
				$subcategory->save();
				Session::flash('statuscode','success');
				return redirect()->back()->with('status','New sub-category added');
			} else {
				Session::flash('statuscode','error');
				return redirect()->back()->with('status','Sub-category already exists');
			}
		}

		public function update(Request $request, $id)
		{
			$subcategory = Sub_category::find($id);
			$subcategory->name = $request->input('updateSubCategoryName');
			if ($request->input('updateSelCategory') != 0) {
					$subcategory->category_id = $request->input('updateSelCategory');
			}
			$subcategory->update();
			Session::flash('statuscode','info');
			return redirect()->back()->with('status','Sub-category is updated');
		}

		public function delete(Request $request, $id)
		{
			$subcategory = Sub_category::find($id);
			$subcategory->companies()->detach();
			$subcategory->delete();
			Session::flash('statuscode','error');
			return redirect()->back()->with('status','Sub-category is deleted');
		}
}

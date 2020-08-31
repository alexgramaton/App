<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Brand;
use App\Models\Company;
use Validator;

class BrandController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function brands($id)
    {
			$company = Company::find($id);
			if (is_null($company)) {
        return $this->sendError('Company not found.');
			}
			if (!$company->brands()->exists()) {
        return $this->sendError('Brands not found.');
      }
      return $this->sendResponse($company->brands()->orderBy('name', 'asc')
      ->get(), 'Brands retrieved successfully.');
		}
		
		 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		//GET
    public function brand($idCompany = null, $idBrand = null)
    {
			if (is_null($idCompany)) {
          return $this->sendError('Company id not found.');
      }
      $company = Company::find($idCompany);
      if (is_null($company)) {
          return $this->sendError('Company not found.');
			}
			if (!$company->brands()->exists()) {
        return $this->sendError('Brands not found.');
			}
			if (is_null($idBrand)) {
          return $this->sendError('Brand id not found.');
      }
			$brand = $company->brands()->where('id', '=', $idBrand)->get();
			if (is_null($brand)) {
          return $this->sendError('Brand with this id not found.');
			}
      return $this->sendResponse($brand, 'Brand retrieved successfully.');
		}
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Certification;
use App\Models\Company;
use Validator;

class CertificationController extends BaseController
{

		public function index()
    {
        $certifications = Certification::all();
        return $this->sendResponse($certifications->toArray(), 'Certifications retrieved successfully.');
		}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function certifications($id = null)
    {
			if (is_null($id)) {
          return $this->sendError('Certification id not found.');
      }
      $company = Company::find($id);
			if (is_null($company)) {
        return $this->sendError('Certification not found.');
			}
			if (!$company->certifications()->exists()) {
        return $this->sendError('Certifications not found.');
      }
      return $this->sendResponse($company->certifications()->orderBy('name', 'asc')
      ->get(), 'Certifications retrieved successfully.');
		}
		
		 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		//GET
    public function certification($idCompany = null, $idCertification = null)
    {
			if (is_null($idCompany)) {
          return $this->sendError('Company id not found.');
      }
      $company = Company::find($idCompany);
      if (is_null($company)) {
          return $this->sendError('Company not found.');
			}
			if (!$company->certifications()->exists()) {
        return $this->sendError('Certification not found.');
			}
			if (is_null($idCertification)) {
          return $this->sendError('Certification id not found.');
      }
			$certification = $company->certifications()->where('id', '=', $idCertification)->get();
			if ($certification->isEmpty()) {
          return $this->sendError('Certification with this id not found.');
			}
      return $this->sendResponse($certification, 'Certification retrieved successfully.');
		}

		/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($id = null, Request $request)
    {
			$input = $request->all();
			$certification = Certification::where('name', '=', $input['name'])->first();
			if ($certification === null) {
				if (is_null($id)) {
          return $this->sendError('Company id not found.');
      	}
				$company = Company::find($id);
				if (is_null($company)) {
        	return $this->sendError('Company not found.');
				}
				$validator = Validator::make($input, [
        	'name' => 'required',
					'picture_url' => 'required'
				]);
      	if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());       
				}
				$certification = Certification::create($input);
				$company->certifications()->save($certification);
				return $this->sendResponse($certification->toArray(), 'Certification created successfully.');
			} else {
				return $this->sendError('Certification already exists');
			}
		}
		
		/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certification $certification)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'picture_url' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $certification->name = $input['name'];
        $certification->detail = $input['picture_url'];
        $certification->save();
        return $this->sendResponse($certification->toArray(), 'Certification updated successfully.');
		}
		
		/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($idCompany = null, $idCertification = null)
    {
			if (is_null($idCompany)) {
          return $this->sendError('Company id not found.');
      }
      $company = Company::find($idCompany);
      if (is_null($company)) {
          return $this->sendError('Company not found.');
			}
			if (!$company->certifications()->exists()) {
        return $this->sendError('Certification not found.');
			}
			if (is_null($idCertification)) {
          return $this->sendError('Certification id not found.');
      }
			$certification = $company->certifications()->where('id', '=', $idCertification)->get();
			if ($certification->isEmpty()) {
          return $this->sendError('Certification with this id not found.');
			}
      $certification->each->delete();
      return $this->sendResponse($certification->toArray(), 'Certification deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Claim;
use Validator;

class ClaimController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function index()
    {
        $claims = Claim::all();
        return $this->sendResponse($claims->toArray(), 'Claims retrieved successfully.');
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
        $claim = Claim::find($id);
        if (is_null($claim)) {
            return $this->sendError('Claim not found.');
        }
        return $this->sendResponse($claim->toArray(), 'Claim retrieved successfully.');
    }
}

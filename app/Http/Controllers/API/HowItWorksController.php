<?php

namespace App\Http\Controllers\API;

use App\Models\HowItWorks;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class HowItWorksController extends BaseController
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function index()
    {
			$howItWorks = HowItWorks::latest('updated_at')->first();
			if (is_null($howItWorks)) {
				return $this->sendError('howItWorks not found.');
			}
			return $this->sendResponse($howItWorks->toArray(), 'howItWorks retrieved successfully.');
		}
}

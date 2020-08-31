<?php

namespace App\Http\Controllers\API;

use App\Models\TermsOfUsage;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class TermsOfUsageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function index()
    {
			$termsOfUsage = TermsOfUsage::latest('updated_at')->first();
			if (is_null($termsOfUsage)) {
				return $this->sendError('termsOfUsage not found.');
			}
			return $this->sendResponse($termsOfUsage->toArray(), 'termsOfUsage retrieved successfully.');
		}
}

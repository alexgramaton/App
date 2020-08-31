<?php

namespace App\Http\Controllers\API;

use App\Models\PrivacyPolicy;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class PrivacyPolicyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function index()
    {
			$privacyPolicy = PrivacyPolicy::latest('updated_at')->first();
			if (is_null($privacyPolicy)) {
				return $this->sendError('privacyPolicy not found.');
			}
			return $this->sendResponse($privacyPolicy->toArray(), 'privacyPolicy retrieved successfully.');
		}
}

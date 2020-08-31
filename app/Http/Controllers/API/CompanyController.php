<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Models;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Brand;
use App\Models\Certification;
use App\Models\Company_image;
use App\Models\Product;
use App\Models\Claim;
use App\User;
use App\Models\Company;
use Validator;

class CompanyController extends BaseController
{

		public function getAll()
		{
			$companies = Company::all();

			$result = [
    	  'success' => true,
    	  'company' => array(),
			];
			foreach ($companies as $company) {  
				$result['company'][] = array(
						'id' => $company->id,
						'isDraft' => (boolean)$company->isDraft,
						'status' => $company->status,
						'user_id' => $company->user_id,
    				'business_name' => $company->business_name,
						'logo_url' => $company->logo_url,
						'description' => $company->description,
						'products_image_url' => $company->products_image_url,
						'website_url' => $company->website_url,
						'company_phone' => $company->company_phone,
						'company_email' => $company->company_email,
						'video_url' => $company->video_url,
						'subcategories' => $company->sub_categories()->orderBy('name', 'asc')
						->get(),
						'claims' => $company->claims()->orderBy('name', 'asc')
						->get(),
						'brands' => $company->brands()->orderBy('name', 'asc')
						->get(),
						'private_label' => $company->private_label,
						'certifications' => $company->certifications()->orderBy('name', 'asc')
						->get(),
						'distinction_1' => $company->distinction_1,
						'distinction_2' => $company->distinction_2,
						'distinction_3' => $company->distinction_3,
						'distinction_4' => $company->distinction_4,
						'distinction_5' => $company->distinction_5,
						'production_capacity' => $company->production_capacity,
						'main_markets' => $company->main_markets,
						'main_sales_channels' => $company->main_sales_channels,
						'products_description' => $company->products_description,
						'images' => $company->images()->orderBy('image_url', 'asc')
						->get(),
						'products' => $company->products()->orderBy('name', 'asc')
						->get(),
						'contact_first_name' => $company->contact_first_name,
						'contact_last_name' => $company->contact_last_name,
						'contact_role' => $company->contact_role,
						'contact_email' => $company->contact_email,
						'contact_phone' => $company->contact_phone,
				);
			}
      return $this->sendResponse($result, 'Companies retrieved successfully.');
		}	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
		//GET
    public function index($idUser = null)
    {		
			if (is_null($idUser)) {
    	  return $this->sendError('User id not found.');
			}
			$user = User::find($idUser);
			if (is_null($user)) {
    		return $this->sendError('User not found.');
			}
			if (!$user->companies()->exists()) {
    		return $this->sendError('Companies not found.');
			}
			$companies = $user->companies()->orderBy('id', 'asc')
						->get();
			$result = [
    	  'success' => true,
    	  'company' => array(),
			];
			foreach ($companies as $company) {  
				$result['company'][] = array(
						'id' => $company->id,
						'business_name' => $company->business_name,
						'isDraft' => (boolean)$company->isDraft,
						'status' => $company->status,
						'user_id' => $company->user_id,
						//'logo_url' => $company->logo_url,
						//'description' => $company->description,
						//'products_image_url' => $company->products_image_url,
						//'website_url' => $company->website_url,
						//'company_phone' => $company->company_phone,
						//'company_email' => $company->company_email,
						//'video_url' => $company->video_url,
						//'subcategories' => $company->sub_categories()->orderBy('name', 'asc')
						//->get(),
						//'claims' => $company->claims()->orderBy('name', 'asc')
						//->get(),
						//'brands' => $company->brands()->orderBy('name', 'asc')
						//->get(),
						//'private_label' => $company->private_label,
						//'certifications' => $company->certifications()->orderBy('name', 'asc')
						//->get(),
						//'distinction_1' => $company->distinction_1,
						//'distinction_2' => $company->distinction_2,
						//'distinction_3' => $company->distinction_3,
						//'distinction_4' => $company->distinction_4,
						//'distinction_5' => $company->distinction_5,
						//'production_capacity' => $company->production_capacity,
						//'main_markets' => $company->main_markets,
						//'main_sales_channels' => $company->main_sales_channels,
						//'products_description' => $company->products_description,
						//'images' => $company->images()->orderBy('image_url', 'asc')
						//->get(),
						//'products' => $company->products()->orderBy('name', 'asc')
						//->get(),
						//'contact_first_name' => $company->contact_first_name,
						//'contact_last_name' => $company->contact_last_name,
						//'contact_role' => $company->contact_role,
						//'contact_email' => $company->contact_email,
						//'contact_phone' => $company->contact_phone,
				);
			}
      return $this->sendResponse($result, 'Companies retrieved successfully.');
		}

		public function submitOnApproval(Request $request)
		{
			$rawData = $request->getContent();
			$decodeData = json_decode($rawData);
			
			$idUser = (int)$decodeData->idUser;
			$idCompany = (int)$decodeData->idCompany;
			
			if (is_null($idUser)) {
        return $this->sendError('User id not found.');
      }
      $user = User::find($idUser);
      if (is_null($user)) {
        return $this->sendError('User not found.');
			}
			if (!$user->companies()->exists()) {
        return $this->sendError('Companies not found.');
			}
			if (is_null($idCompany)) {
          return $this->sendError('Company id not found.');
      }
			$company = $user->companies()->where('id', '=', $idCompany)->first();
			if (is_null($company)) {
          return $this->sendError('Company with this id not found.');
			}
			if ($company->status == 1) {
				 return $this->sendError('The company is already approved');
			}
			if (($company->isDraft == FALSE) && ($company->status == 0)) {
        return $this->sendError('The company has already been submitted for approval.');
			}
			$company->isDraft = FALSE;
			$company->save();
			return $this->sendResponse(True, 'Company sending for approval');
		}

		/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		//GET
    public function show($idUser = null, $idCompany = null)
    {
			if (is_null($idUser)) {
        return $this->sendError('User id not found.');
      }
      $user = User::find($idUser);
      if (is_null($user)) {
        return $this->sendError('User not found.');
			}
			if (!$user->companies()->exists()) {
        return $this->sendError('Companies not found.');
			}
			if (is_null($idCompany)) {
          return $this->sendError('Company id not found.');
      }
			$company = $user->companies()->where('id', '=', $idCompany)->first();
			if (is_null($company)) {
          return $this->sendError('Company with this id not found.');
			}
			$result = [
          'success' => true,
          'company' => array(),
			];
			$result['company'][] = array(
					'id' => $company->id,
					'isDraft' => (boolean)$company->isDraft,
					'status' => $company->status,
    			'business_name' => $company->business_name,
					'logo_url' => $company->logo_url,
					'description' => $company->description,
					'products_image_url' => $company->products_image_url,
					'website_url' => $company->website_url,
					'company_phone' => $company->company_phone,
					'company_email' => $company->company_email,
					'video_url' => $company->video_url,
					'subcategories' => $company->sub_categories()->orderBy('name', 'asc')
					->get(),
					'claims' => $company->claims()->orderBy('name', 'asc')
					->get(),
					'brands' => $company->brands()->orderBy('name', 'asc')
					->get(),
					'private_label' => $company->private_label,
					'certifications' => $company->certifications()->orderBy('name', 'asc')
					->get(),
					'distinction_1' => $company->distinction_1,
					'distinction_2' => $company->distinction_2,
					'distinction_3' => $company->distinction_3,
					'distinction_4' => $company->distinction_4,
					'distinction_5' => $company->distinction_5,
					'production_capacity' => $company->production_capacity,
					'main_markets' => $company->main_markets,
					'main_sales_channels' => $company->main_sales_channels,
					'products_description' => $company->products_description,
					'productImg' => $company->images()->orderBy('image_url', 'asc')
					->get(),
					'products' => $company->products()->orderBy('name', 'asc')
					->get(),
					'contact_first_name' => $company->contact_first_name,
					'contact_last_name' => $company->contact_last_name,
					'contact_role' => $company->contact_role,
					'contact_email' => $company->contact_email,
					'contact_phone' => $company->contact_phone,
			);
			
      return $this->sendResponse($result, 'Company retrieved successfully.');
		}

		/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$rawData = $request->getContent();
			$decodeData = json_decode($rawData);

			$id = (int)$decodeData->id;
			
			if (is_null($id)) {
        return $this->sendError('User id not found.');
			}

			$userInDb = User::find($id);
			if (is_null($userInDb)) {
        return $this->sendError('User not found.');
			}
			//return response()->json($userInDb, 200);
	
			$dataCompany = $decodeData->rawData;
			if (is_null($dataCompany)) {
        return $this->sendError('Data not found');
			}

			// creating and filling data new company from request
			$company = new Company;
			// not null field
			$company->business_name = $dataCompany->business_name;
			$company->logo_url = $dataCompany->logo_url;
			$company->description = $dataCompany->description;
			$company->products_image_url = $dataCompany->products_image_url;
			$company->website_url = $dataCompany->website_url;
			$company->company_phone = (int)$dataCompany->company_phone;
			$company->company_email = $dataCompany->company_email;
			$company->private_label = (int)$dataCompany->private_label;

			//can be null field
			$company->video_url  = $dataCompany->video_url;
			$company->distinction_1  = $dataCompany->distinction_1;
			$company->distinction_2  = $dataCompany->distinction_2;
			$company->distinction_3  = $dataCompany->distinction_3;
			$company->distinction_4  = $dataCompany->distinction_4;
			$company->distinction_5  = $dataCompany->distinction_5;
			$company->production_capacity  = $dataCompany->production_capacity;
			$company->main_markets  = $dataCompany->main_markets;
			$company->main_sales_channels  = $dataCompany->main_sales_channels;
			$company->products_description  = $dataCompany->products_description;
			$company->contact_first_name  = $dataCompany->contact_first_name;
			$company->contact_last_name  = $dataCompany->contact_last_name;
			$company->contact_role  = $dataCompany->contact_role;
			$company->contact_email  = $dataCompany->contact_email;
			$company->contact_phone  = $dataCompany->contact_phone;
			
			$company->user()->associate($userInDb);
			$company->save();
			//attaching data with relation in db

			//-claims
			if(!empty($dataCompany->claims))
			{
				foreach ($dataCompany->claims as $claim) {
    			$claimInDb = Claim::where('name', '=', $claim->name)->first();
					if (is_null($claimInDb)) {
						continue;
					}
					$company->claims()->attach($claimInDb);
				}
			}

			//-subcategories
			if(!empty($dataCompany->categories))
			{
				foreach ($dataCompany->categories as $category) {
					$categoryInDb = Category::where('name', '=', $category->name)->first();
					if (is_null($categoryInDb)) {
						continue;
					}
					if (!$categoryInDb->sub_categories()->exists()) {
						continue;
					}
					$subcategories = $categoryInDb->sub_categories()->orderBy('name', 'asc')
					->get();
					foreach ($subcategories as $subcategory) {
						$company->sub_categories()->attach($subcategory);
						$company->save();
					}
				}
			}
			$company->save();

			//-brands
			if(!empty($dataCompany->brands))
			{
				foreach ($dataCompany->brands as $brand) {
					$newBrand = new Brand;
					$newBrand->name = $brand->name;
					$newBrand->picture_url = $brand->img;
					$newBrand->company_id = $company->id;
					$company->brands->add($newBrand);
					$newBrand->save();
				}
			}
			$company->save();

			//-certifications
			if(!empty($dataCompany->certifications))
			{
				foreach ($dataCompany->certifications as $certification) {
					$newCertification = new Certification;
					$newCertification->name = $certification->name;
					$newCertification->picture_url = $certification->img;
					$newCertification->company_id = $company->id;
					$company->certifications->add($newCertification);
					$newCertification->save();
				}
			}

			//-company_image
			if(!empty($dataCompany->productImg))
			{
				foreach ($dataCompany->productImg as $prdImg) {
					$productImage = new Company_image;
					$productImage->image_url = $prdImg->data;
					$productImage->company_id = $company->id;
					$productImage->save();
					$company->images->add($productImage);
				}
			}

			//-products
			if(!empty($dataCompany->products))
			{
				$productsArrayFullInfo = (array)$dataCompany->products;
			  $productsMainData = next($productsArrayFullInfo);
				foreach ($productsMainData as $product) {
					$newProduct = new Product;
					$newProduct->name = $product->name;
					$newProduct->self_life = $product->shelfLife;
					$newProduct->storage_type = (int)$product->storageType;
					$newProduct->company_id = $company->id;
					$newProduct->sub_category_id = $product->subcategory_id;

					$subcateg = Sub_category::find($product->subcategory_id);

					$company->products->add($newProduct); //One to Many saving
					$newProduct->sub_category()->associate($subcateg); //Many to One saving
					$newProduct->save();
				}
			}

			$submit = (int)$decodeData->submit;
			if ($submit == 1) {
					$company->isDraft = False;
					$company->save();
			}
			if ($submit == 0) {
					$company->isDraft = True;
					$company->save();
			}

			return $this->sendResponse($company->id, 'Company added successfully.');
		}
		
		public function update(Request $request)
    {
    	$rawData = $request->getContent();
			$decodeData = json_decode($rawData);

			$idUser = (int)$decodeData->idUser;
			$idCompany = (int)$decodeData->idCompany;
			$submit = (int)$decodeData->submit;

			if (is_null($idUser)) {
        return $this->sendError('User id not found.');
			}

			if (is_null($idCompany)) {
        return $this->sendError('Company id not found.');
			}

			if (is_null($submit)) {
        return $this->sendError('submit parameter not found.');
			}

			$userInDb = User::find($idUser);
			if (is_null($userInDb)) {
        return $this->sendError('User not found.');
			}
			//return response()->json($userInDb, 200);
	
			$dataCompany = $decodeData->rawData;
			if (is_null($dataCompany)) {
        return $this->sendError('Data not found');
			}

			$company = Company::where('id', '=', $idCompany)->first();
			if (is_null($company)) {
        return $this->sendError('Company not found');
			}
			// creating and filling data new company from request
			//$company = new Company;
			// not null field
			//$companyWithNewName = Company::where('business_name', '=',$rawDataCompany->business_name)->first();
			//if (!is_null($companyWithNewName)) {
      //  return $this->sendError('A company with this name already exists');
			//}

			$company->business_name = $dataCompany->business_name;
			$company->logo_url = $dataCompany->logo_url;
			$company->description = $dataCompany->description;
			$company->products_image_url = $dataCompany->products_image_url;
			$company->website_url = $dataCompany->website_url;
			$company->company_phone = (int)$dataCompany->company_phone;
			$company->company_email = $dataCompany->company_email;
			$company->private_label = (int)$dataCompany->private_label;

			//can be null field
			$company->video_url  = $dataCompany->video_url;
			$company->distinction_1  = $dataCompany->distinction_1;
			$company->distinction_2  = $dataCompany->distinction_2;
			$company->distinction_3  = $dataCompany->distinction_3;
			$company->distinction_4  = $dataCompany->distinction_4;
			$company->distinction_5  = $dataCompany->distinction_5;
			$company->production_capacity  = $dataCompany->production_capacity;
			$company->main_markets  = $dataCompany->main_markets;
			$company->main_sales_channels  = $dataCompany->main_sales_channels;
			$company->products_description  = $dataCompany->products_description;
			$company->contact_first_name  = $dataCompany->contact_first_name;
			$company->contact_last_name  = $dataCompany->contact_last_name;
			$company->contact_role  = $dataCompany->contact_role;
			$company->contact_email  = $dataCompany->contact_email;
			$company->contact_phone  = $dataCompany->contact_phone;
			
			$company->user()->associate($userInDb);
			$company->save();
			//attaching data with relation in db

			//-claims
			if(!empty($dataCompany->claims))
			{
				foreach ($dataCompany->claims as $claim) {
    			$claimInDb = Claim::where('name', '=', $claim->name)->first();
					if (is_null($claimInDb)) {
						continue;
					}
					$company->claims()->attach($claimInDb);
				}
			}

			//-subcategories
			if(!empty($dataCompany->categories))
			{
				foreach ($dataCompany->categories as $category) {
					$categoryInDb = Category::where('name', '=', $category->name)->first();
					if (is_null($categoryInDb)) {
						continue;
					}
					if (!$categoryInDb->sub_categories()->exists()) {
						continue;
					}
					$subcategories = $categoryInDb->sub_categories()->orderBy('name', 'asc')
					->get();
					foreach ($subcategories as $subcategory) {
						$company->sub_categories()->attach($subcategory);
						$company->save();
					}
				}
			}
			$company->save();

			//-brands
			if(!empty($dataCompany->brands))
			{
				foreach ($dataCompany->brands as $brand) {
					$newBrand = new Brand;
					$newBrand->name = $brand->name;
					$newBrand->picture_url = $brand->img;
					$newBrand->company_id = $company->id;
					$company->brands->add($newBrand);
					$newBrand->save();
				}
			}
			$company->save();

			//-certifications
			if(!empty($dataCompany->certifications))
			{
				foreach ($dataCompany->certifications as $certification) {
					$newCertification = new Certification;
					$newCertification->name = $certification->name;
					$newCertification->picture_url = $certification->img;
					$newCertification->company_id = $company->id;
					$company->certifications->add($newCertification);
					$newCertification->save();
				}
			}

			//-company_image
			if(!empty($dataCompany->productImg))
			{
				foreach ($dataCompany->productImg as $prdImg) {
					$productImage = new Company_image;
					$productImage->image_url = $prdImg->data;
					$productImage->company_id = $company->id;
					$productImage->save();
					$company->images->add($productImage);
				}
			}

			//-products
			if(!empty($dataCompany->products))
			{
				$productsArrayFullInfo = (array)$dataCompany->products;
			  $productsMainData = next($productsArrayFullInfo);
				foreach ($productsMainData as $product) {
					$newProduct = new Product;
					$newProduct->name = $product->name;
					$newProduct->self_life = $product->shelfLife;
					$newProduct->storage_type = (int)$product->storageType;
					$newProduct->company_id = $company->id;
					$newProduct->sub_category_id = $product->subcategory_id;

					$subcateg = Sub_category::find($product->subcategory_id);

					$company->products->add($newProduct); //One to Many saving
					$newProduct->sub_category()->associate($subcateg); //Many to One saving
					$newProduct->save();
				}
			}

			if ($submit == 1) {
				if ($company->status == 1) {
					$company->save();
					return $this->sendResponse($company->id, 'Company updated successfully.');
				}
				if (($company->isDraft == FALSE) && ($company->status == 0)) {
					$company->save();
          return $this->sendResponse($company->id, 'Company updated successfully.');
				}
				$company->isDraft = FALSE;
				$company->save();
			}

			return $this->sendResponse($company->id, 'Company updated successfully.');
    }

    public function delete(Request $request)
    {
			$rawData = $request->getContent();
			$decodeData = json_decode($rawData);
			
			$idUser = (int)$decodeData->idUser;
			$idCompany = (int)$decodeData->idCompany;
			
			if (is_null($idUser)) {
        return $this->sendError('User id not found.');
      }
      $user = User::find($idUser);
      if (is_null($user)) {
        return $this->sendError('User not found.');
			}
			if (!$user->companies()->exists()) {
        return $this->sendError('Companies not found.');
			}
			if (is_null($idCompany)) {
          return $this->sendError('Company id not found.');
      }
			$company = $user->companies()->where('id', '=', $idCompany)->first();
			if (is_null($company)) {
          return $this->sendError('Company with this id not found.');
			}
			$company->sub_categories()->detach();
			$company->claims()->detach();
			$company->delete();
			return $this->sendResponse(null, 'Company deleted successfully.');
    }
}

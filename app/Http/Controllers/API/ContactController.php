<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Contact;
use Validator;
//use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
use Mail;	

class ContactController extends BaseController
{
    /**
     * Send new message 'contact us'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
		//POST
    public function addFeedback(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
						'name' => 'required',
						'email' => 'required',
						'company' => 'required',
						'phone',
						'website_url',
						'subject' => 'required',
						'message' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
				$contact = Contact::create($input);
				$phone; $website_url;
				//if(is_null($input['phone']))
				//{
				//	$phone = "";
				//}
				//else {$phone = $input['phone'];}
				//if(is_null($input['website_url'])) {$website_url = "";}
				//else {$website_url = $input['website_url'];}
				$data = array(
        	'name' => $input['name'],
					'email' => $input['email'],
					'company' => $input['company'],
					'phone' => $input['phone'],
					'website_url' => $input['website_url'],
					'subject' => $input['subject'],
					'message' => $input['message']
				);

				Mail::to($input['email'])->send(new \App\Mail\MailSender($data));
				return $this->sendResponse($data, 'Email send successfully.');
    }
}

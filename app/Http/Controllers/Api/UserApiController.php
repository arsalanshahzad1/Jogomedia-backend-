<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserApiController extends Controller
{
    public function sendUserData(Request $request)
    {
        $input = $request->all();

    	$validator = Validator::make($input, [
            'user_id' => 'required',
            'user_address' => 'required'
        ]);
 
        if ($validator->fails()) {
        	$data = [
	    		'status' => false,
	    		'message' => $validator->errors()->first()
	    	];

        	return response()->json($data, 403);
        }
        
        return response()->json($input, 201);
    }
}

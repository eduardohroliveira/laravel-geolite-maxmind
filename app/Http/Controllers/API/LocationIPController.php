<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\MaxmindGeoIP;

class LocationIPController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    /**
     * Search for country associated with IP
     *
     * @param  mixed $request
     *
     * @return Response JSON with (country_code, country_name) or 
     * validation fields that failed.
     */
    public function show(Request $request) 
    {
        
        //the only required input is the IP parameter
        $rules = [
            'IP' => 'required|string|min:6|max:191',
        ];

        //create and validate input
        $validator = Validator::make($request->all(), $rules);
        //if fails, then returns BAD REQUEST status code
        if($validator->fails()) {
            return response()->json($validator->errors(), 400); //bad request
        }

        //input ok :: try to find country associated with this IP
        $objeto = MaxmindGeoIP::getCountryByIP($request['IP']);

        //no record found, then returns NOT FOUND status code
        if(is_null($objeto)) {
            return response()->json(['IP'=>['IP not found.']], 404); //not found
        }
        
        //return data found and success status
        return response()->json($objeto, 200); //success
    }

}

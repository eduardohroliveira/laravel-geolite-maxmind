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

    public function show(Request $request) 
    {
        
        $rules = [
            'IP' => 'required|string|min:6|max:191',
        ];

        $validator = Validator::make($request->all(), $rules);

        $IP = $request['IP'];

        if($validator->fails()) {
            return response()->json($validator->errors(), 400); 
        }

        $objeto = MaxmindGeoIP::getCountryByIP($IP);
        if(is_null($objeto)) {
            return response()->json(['IP'=>['IP not found.']], 404);
        }
        
        return response()->json($objeto, 200);
    }

    public function errors()
    {
        return response()->json(['message' => 'Generic error'], 501);
    }
}

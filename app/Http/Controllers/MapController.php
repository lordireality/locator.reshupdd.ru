<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    function getCity(Request $request){
        return "yoba";
    }
    function suggestAdress(Request $request){
        $inputData = $request->input();
        $validRules = [
           'adress' => 'required'
        ];
        $validator = Validator::make($inputData,$validRules);
        if($validator->passes()){
            $adress = $inputData["adress"];
            $token = "1d126b7dc38ffd86e29b3399f3a0b027e6450283";
            $dadata = new \Dadata\DadataClient($token, null);
            $result = $dadata->suggest("address", $adress);
            return response() -> json(["status" => "200","apiprovider"=>"locator.reshupdd.ru","content"=>$result],200);
        } else {
            return response() -> json(["status" => "200","apiprovider"=>"locator.reshupdd.ru","content"=>[]],200);
        }
    }

    function getAccidents(Request $request){
        $inputData = $request->input();
        $validRules = [
            'lat' => 'required',
            'lon' => 'required',
            'distance' => 'required'
         ];
         //getaccidents
         $validator = Validator::make($inputData,$validRules);
         if($validator->passes()){
            $lat = floatval($inputData["lat"]);
            $lon = floatval($inputData["lon"]);
            $distance = floatval($inputData["distance"]);
            $result = DB::select('SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( '.$lat.' - `lat`) *  pi()/180 / 2), 2) +COS( '.$lat.' * pi()/180) * COS(`lat` * pi()/180) * POWER(SIN(( '.$lon.' - `lon`) * pi()/180 / 2), 2) ))) as distance from `accidentspoints` having  distance <= '.$distance.' order by distance');
            return response() -> json(["status" => "200","apiprovider"=>"locator.reshupdd.ru","content"=>$result],200);
        } else {
            return response() -> json(["status" => "422","apiprovider"=>"locator.reshupdd.ru","message"=>$validator->messages()],422);
         }
    }

}

<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Redirect;

class ApiHelper
{

	public static function getWithoutToken($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL") . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return ApiHelper::parseJson($response, "ApiHelper@getWithoutToken", $err);
    }

    public static function postWithoutToken($iData, $url)
    {
        $data = http_build_query($iData);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL") . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return ApiHelper::parseJson($response, "ApiHelper@postWithoutToken", $err);
    }

    public static function getWithToken($token, $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL") . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $token,
                "Content-Type: application/json",
            ),
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $returnRes = ApiHelper::authValidCheck($response, $err);
        return $returnRes;
    }

    public static function postWithToken($token, $iData, $url)
    {
        $data = http_build_query($iData);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL") . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $token
            ),
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $returnRes = ApiHelper::authValidCheck($response, $err);
        return $returnRes;
    }

    public static function parseJson( $response , $messageLog , $err)
    {
        if ($err) {
            \Log::error($messageLog, ['message' => $response]);
            return false;
        }
        $responseJs = json_decode($response);
            if ( App::environment() !== 'production' && $responseJs == null ) {
        } else if ($responseJs == null ) {
            \Log::error("Client Response error ", ['response' => $response]);
        }
        return $responseJs;
    }


    public static function authValidCheck($response, $err)
    {
        $jsonRes = ApiHelper::parseJson($response, "ApiHelper@getWithToken", $err);
        if($jsonRes && isset($jsonRes->success) && $jsonRes->success == false && isset($jsonRes->message_code) && $jsonRes->message_code == 401 ) {
            $error = [];
            $error['message'] = $jsonRes->message;
            Redirect::action("Auth\LoginController@index")->with(['error' => $error])->send();
        }

        return $jsonRes;
    }
}

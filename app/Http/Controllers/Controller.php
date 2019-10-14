<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $client;
    
    function __construct(){
        $this->client = new Client(['headers' => ['Api-Token' => session('api-token')]]);
    }
    
    function handleError($code) {
        switch ($code) {
            case Response::HTTP_UNAUTHORIZED:
                return view("pages.error.401");
                break;
            case Response::HTTP_FORBIDDEN:
                return view("pages.error.403");
                break;
            case Response::HTTP_NOT_FOUND:
                return view("pages.error.404");
                break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return view("pages.error.500");
                break;
            default:
                return view('auth.login');
        }
    }
}

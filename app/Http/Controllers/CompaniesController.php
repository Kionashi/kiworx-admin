<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CompaniesController extends Controller
{
    public function __construct()
    {
    
    }

    public function index(){
        $client = new Client();
        $res = $client->request('GET', env('API_BASE_URL').'admin/company', [
        ]);
        dump($res->getStatusCode());
        // "200"
        dump($res->getHeader('content-type')[0]);
        // 'application/json; charset=utf8'
        dump($res->getBody());
        
        return view("pages.backend.companies.index")
            ->with('companies', $companies)
            ;

    }
}

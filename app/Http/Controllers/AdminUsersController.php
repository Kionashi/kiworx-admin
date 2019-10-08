<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AdminUsersController extends Controller
{
    public function index(){
        $client = new Client();
        $res = $client->request('GET', env('API_BASE_URL').'admin/users');
        $adminUsers = json_decode($res->getBody(),true);

        return view("pages.backend.admin-users.index")
            ->with('adminUsers', $adminUsers)
            ;

    }
}

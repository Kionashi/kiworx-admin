<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class AdminUsersController extends Controller
{
    public function index(){
        if (!session()->exists('admin.id')) {
            session([
                'admin.id' => 1,
                'admin.name' => 'Víctor',
                'admin.lastname' => 'Cardozo'
            ]);
        }
        $client = new Client();
        $res = $client->request('GET', env('API_BASE_URL').'admin/users');
        $adminUsers = json_decode($res->getBody(),true);

        return view("pages.backend.admin-users.index")
            ->with('adminUsers', $adminUsers)
            ;

    }
}

<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

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

    public function create(){
        $client = new Client();
        $res = $client->request('GET', env('API_BASE_URL').'admin/user-roles');
        $roles = json_decode($res->getBody(),true);
        return view("pages.backend.admin-users.create")
            ->with('roles',$roles)
        ;
    }

    public function store(Request $request){
        $all = $request->all();
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $password = $request->password;
        $adminUserRoleId = $request->adminUserRoleId;
        
        $client = new Client();
        $body = [
            'all' => $all,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'adminUserRoleId' => $adminUserRoleId,
            // 'nested_field' => [
            //     'nested' => 'hello'
            // ]
            ];

            try{
                $res = $client->post(env('API_BASE_URL').'admin/users',['body'=> json_encode($body)]);
            } catch(ClientException $e){
                dd($e);
            } catch(ServerException $e){
                dd($e->getCode());
            }
        $response = json_decode($res->getBody());
        // dd($response);
        return redirect()->route('admin-users');
    }

    public function details($id){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/users/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $adminUser = json_decode($res->getBody(),true);
        return view("pages.backend.admin-users.details")
            ->with('adminUser', $adminUser)
            ;
    }
    
    public function edit($id){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/users/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $adminUser = json_decode($res->getBody(),true);

        $res = $client->request('GET', env('API_BASE_URL').'admin/user-roles');
        $roles = json_decode($res->getBody(),true);

        return view("pages.backend.admin-users.edit")
            ->with('adminUser', $adminUser)
            ->with('roles', $roles)
            ;
    }

    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $password = $request->password;
        $adminUserRoleId = $request->adminUserRoleId;
        $client = new Client();
        $body = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'adminUserRoleId' => $adminUserRoleId,
            // 'nested_field' => [
            //     'nested' => 'hello'
            // ]
            ];

            try{
                $res = $client->put(env('API_BASE_URL').'admin/users/'.$id, ['body'=> json_encode($body)]);
            } catch(ClientException $e){
                dd($e);
            } catch(ServerException $e){
                dd($e->getCode());
            }
        $response = json_decode($res->getBody());
        return redirect()->route('admin-users');
    }

    public function destroy($id){
       
        $client = new Client();
        try{
            $res = $client->delete(env('API_BASE_URL').'admin/users/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }

        return redirect()->route('admin-users');
    }
}

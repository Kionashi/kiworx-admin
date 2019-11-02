<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(){
        try{
            // Get admin user list
            $res = $this->client->get(env('API_BASE_URL').'admin/comments');
            
            // Parse response
            $adminUsers = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.admin-users.index")
                ->with('adminUsers', $adminUsers)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function create(){
        try {
            // Get admin user roles
            $res = $this->client->get(env('API_BASE_URL').'admin/user-roles');
            
            // Parse response
            $roles = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.admin-users.create")
                ->with('roles',$roles)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function store(Request $request){
        
        try{
            // Build request body
            $body = [
                'all' => $request->all(),
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => $request->password,
                'adminUserRoleId' => $request->adminUserRoleId,
            ];
            
            // Store admin user
            $this->client->post(env('API_BASE_URL').'admin/admin-users',['body'=> json_encode($body)]);
            
            // Redirect to list
            return redirect()->route('admin-users');
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function details($id){
        try{
            // Get admin user details
            $res = $this->client->get(env('API_BASE_URL').'admin/admin-users/'.$id);
            
            // Parse respoonse
            $adminUser = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.admin-users.details")
                ->with('adminUser', $adminUser)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    public function edit($id){
        try{
            // Get admin user details
            $res = $this->client->get(env('API_BASE_URL').'admin/admin-users/'.$id);
            
            // Parse response
            $adminUser = json_decode($res->getBody(),true);
            
            // Get admin roles
            $res = $this->client->get(env('API_BASE_URL').'admin/user-roles');
            
            // Parse response
            $roles = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.admin-users.edit")
                ->with('adminUser', $adminUser)
                ->with('roles', $roles)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function update(Request $request){
        
        try{
            // Build request body
            $body = [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => $request->password,
                'adminUserRoleId' => $request->adminUserRoleId,
            ];
            // Update admin user
            $this->client->put(env('API_BASE_URL').'admin/admin-users/'.$request->id, ['body'=> json_encode($body)]);
            
            // Redirect to list
            return redirect()->route('admin-users');
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function destroy($id){
        try{
            // Delete record
            $this->client->delete(env('API_BASE_URL').'admin/admin-users/'.$id);
            
            // Redirect to list
            return redirect()->route('admin-users');
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }

    }
}

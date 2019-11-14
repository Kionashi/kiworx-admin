<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class ApplicantsController extends Controller
{
    
    public function details($id){
        try {
            // Get user
            $res = $this->client->get(env('API_BASE_URL').'admin/applicants/'.$id);
            $response = json_decode($res->getBody(),true);
            $previusApplicant = null;
            $nextApplicant = null;
            foreach ($response['applicants'] as $i => $applicant) {
                if ($applicant['id'] == $id) {
                    $previusApplicant = array_key_exists($i-1, $response['applicants'])?$response['applicants'][$i-1]:null;
                    $nextApplicant = array_key_exists($i+1, $response['applicants'])?$response['applicants'][$i+1]:null;
                }
                
            }
//             dd($response);
            // Return view
            return view("pages.backend.applicants.details")
                ->with('applicant', $response['applicant'])
                ->with('previusApplicant', $previusApplicant)
                ->with('nextApplicant', $nextApplicant)
            ;
        } catch(RequestException $e) {
            // Handle client unexpected error
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
            $body = array();
            if($request->has('name')) $body['name'] = $request->name;
            if($request->has('lastname')) $body['lastname'] = $request->lastname;
            if($request->has('email')) $body['email'] = $request->email;
            if($request->has('password')) $body['password'] = $request->password;
            if($request->has('adminUserRoleId')) $body['adminUserRoleId'] = $request->adminUserRoleId;
            $id = $request->has('adminUserRoleId')?$request->id:session('admin.id'); 
            
            // Update admin user
            $this->client->put(env('API_BASE_URL').'admin/admin-users/'.$id, ['body'=> json_encode($body)]);
            
            // Validate if comes from profile
            if(route('profile') == url()->previous()) {
                // Redirect to profile
                return redirect()->route('profile')->with('successMsg', 'Updated');
            } else {
                // Redirect to list
                return redirect()->route('admin-users');
            }
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function destroy($id) {
        try{
            // Delete record
            $this->client->delete(env('API_BASE_URL').'admin/admin-users/'.$id);
            
            // Redirect to list
            return redirect()->route('admin-users');
        } catch(RequestException $e) {
            return $this->handleError($e->getCode());
        }
    }
    
    public function profile() {
        try {
            // Get admin user details
            $res = $this->client->get(env('API_BASE_URL').'admin/admin-users/'.session('admin.id'));
            
            // Parse respoonse
            $adminUser = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.admin-users.profile")
                ->with('adminUser', $adminUser)
            ;
        } catch(RequestException $e) {
            return $this->handleError($e->getCode());
        }
    }
    
    public function changePassword() {
        try{
            // Get admin user details
            $res = $this->client->get(env('API_BASE_URL').'admin/admin-users/'.session('admin.id'));
            
            // Parse respoonse
            $adminUser = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.admin-users.change-password")
                ->with('adminUser', $adminUser)
            ;
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    public function updatePassword(Request $request) {
        try{
            // Build request body
            $body = [
                'id'        => session('admin.id'),
                'password'  => $request->password,
            ];
            // Update admin user
            $this->client->put(env('API_BASE_URL').'admin/admin-users/'.session('admin.id'), ['body'=> json_encode($body)]);
            
            // Redirect to profile
            return redirect()->route('profile');
            
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
}

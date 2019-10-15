<?php

namespace App\Http\Controllers;

use function Box\Spout\Common\Helper\GlobalFunctionsHelper\fopen;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    
    public function index() {
        try {
            $res = $this->client->get(env('API_BASE_URL').'admin/companies', []);
            $companies = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.index")
                ->with('companies', $companies)
            ;
        } catch(ClientException $e){
            dd($e->getCode());
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }
    
    public function create() {
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/admin-users');
            $adminUsers = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.create")
                ->with('adminUsers',$adminUsers)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }
    
    public function store(Request $request) {
        try {
            $logo = $request->file('logo');
            $backgroundImage = $request->file('backgroundImage');
            $keyPersonImage = $request->file('keyPersonImage');
            
            $logoPath = $logo->getPathname();
            $logoMime = $logo->getmimeType();
            $logoName  = $logo->getClientOriginalName();
            
            $backgroundImagePath = $backgroundImage->getPathname();
            $backgroundImageMime = $backgroundImage->getmimeType();
            $backgroundImageName  = $backgroundImage->getClientOriginalName();
            
            $keyPersonImagePath = $keyPersonImage->getPathname();
            $keyPersonImageMime = $keyPersonImage->getmimeType();
            $keyPersonImageName  = $keyPersonImage->getClientOriginalName();
            
            $body = [
                'all' => $request->all(),
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'address' => $request->address,
                'address_url' => $request->address_url,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'keyPersonName' => $request->keyPersonName,
                'keyPersonTitle' => $request->keyPersonTitle,
                'website' => $request->website,
                'adminUserId' => $request->adminUserId,
            ];
            $this->client->post(env('API_BASE_URL').'admin/companies',[
                'body'=> json_encode($body),
                'multipart' => [
                    [
                        'name'     => 'logo',
                        'filename' => $logoName,
                        'Mime-Type'=> $logoMime,
                        'contents' => fopen( $logoPath, 'r' ),
                    ],
                    [
                        'name'     => 'backgroundImage',
                        'filename' => $backgroundImageName,
                        'Mime-Type'=> $backgroundImageMime,
                        'contents' => fopen( $backgroundImagePath, 'r' ),
                    ],
                    [
                        'name'     => 'keyPersonImage',
                        'filename' => $keyPersonImageName,
                        'Mime-Type'=> $keyPersonImageMime,
                        'contents' => fopen( $keyPersonImagePath, 'r' ),
                    ],
                ]
            ]);
            return redirect()->route('companies');
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e);
        }
    }

    public function details($id) {
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/companies/'.$id);
            $company = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.details")
                ->with('company', $company)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }
    
    public function edit($id) {
        try {
            $res = $this->client->get(env('API_BASE_URL').'admin/companies/'.$id);
            $company = json_decode($res->getBody(),true);
            $res = $this->client->get(env('API_BASE_URL').'admin/users');
            $adminUsers = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.edit")
                ->with('adminUsers', $adminUsers)
                ->with('company', $company)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }
    
    public function update(Request $request) {
        try{
            $logo = $request->file('logo');
            $backgroundImage = $request->file('backgroundImage');
            $keyPersonImage = $request->file('keyPersonImage');
            $body = [
                'all' => $request->all(),
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'address' => $request->address,
                'address_url' => $request->address_url,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'keyPersonName' => $request->keyPersonName,
                'keyPersonTitle' => $request->keyPersonTitle,
                'website' => $request->website,
                'adminUserId' => $request->adminUserId,
            ];
            
            $this->client->put(env('API_BASE_URL').'admin/companies/'.$request->id, ['body'=> json_encode($body)]);
            return redirect()->route('companies');
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }
    
    public function destroy($id) {
        try {
            $this->client->delete(env('API_BASE_URL').'admin/companies/'.$id);
            return redirect()->route('companies');
        } catch(ClientException $e) {
            dd($e);
        } catch(ServerException $e) {
            dd($e->getCode());
        }
        
    }
}

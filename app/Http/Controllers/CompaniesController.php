<?php

namespace App\Http\Controllers;

use function Box\Spout\Common\Helper\GlobalFunctionsHelper\fopen;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    
    public function index() {
        try {
            $res = $this->client->get(env('API_BASE_URL').'admin/companies');
            $companies = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.index")
                ->with('companies', $companies)
            ;
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
    }
    
    public function create() {
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/admin-users');
            $adminUsers = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.create")
                ->with('adminUsers',$adminUsers)
            ;
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
    }
    
    public function store(Request $request) {
        try {
            
            $body = $request->all();
            
            // Build request body
            if ($request->hasFile('logo') && $request->logo->extension() == 'png' && $request->hasFile('backgroundImage') && ($request->backgroundImage->extension() == 'jpg' || $request->backgroundImage->extension() == 'png')) {
                // Store file
                $fileName = Str::random(10).'.'.$request->logo->extension();
                $request->logo->storeAs('public/companies', $fileName);
                
                $body['logo'] = asset('storage/companies/'.$fileName);
                
                // Store file
                $fileName = Str::random(10).'.'.$request->backgroundImage->extension();
                $request->backgroundImage->storeAs('public/companies', $fileName);
                
                // Build request body
                $body['backgroundImage'] = asset('storage/companies/'.$fileName);
            } else {
                return redirect()->route('companies')->withErrors('Wrong format');
            }
            
            // Store applyment
            $res = $this->client->post(env('API_BASE_URL').'admin/companies', ['body'=> json_encode($body)]);
            
            // Explicitly cast the body to a string
            $stringBody = json_decode($res->getBody(true));
//             dd($stringBody);
            
            // Redirect to list
            return redirect()->route('companies');
            
//             $this->client->post(env('API_BASE_URL').'admin/companies',[
//                 'body'=> json_encode($body),
//             ]);
//             return redirect()->route('companies');
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
    }

    public function details($id) {
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/companies/'.$id);
            $company = json_decode($res->getBody(),true);
            
            return view("pages.backend.companies.details")
                ->with('company', $company)
            ;
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
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
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
    }
    
    public function update(Request $request) {
        try{
            $body = $request->all();
            // Build request body
            if ($request->hasFile('logo') && $request->logo->extension() == 'png' && $request->hasFile('backgroundImage') && ($request->backgroundImage->extension() == 'jpg' || $request->backgroundImage->extension() == 'png')) {
                // Store file
                $fileName = Str::random(10).'.'.$request->logo->extension();
                $request->logo->storeAs('public/companies', $fileName);
                
                $body['logo'] = asset('storage/companies/'.$fileName);
                
                // Store file
                $fileName = Str::random(10).'.'.$request->backgroundImage->extension();
                $request->backgroundImage->storeAs('public/companies', $fileName);
                
                // Build request body
                $body['backgroundImage'] = asset('storage/companies/'.$fileName);
            }
            
            $res = $this->client->put(env('API_BASE_URL').'admin/companies/'.$request->id, ['body' => json_encode($body)]);
            
            // Explicitly cast the body to a string
            $stringBody = json_decode($res->getBody(true));
//             dd($stringBody);
            if (property_exists($stringBody->response, 'oldLogo') && $stringBody->response->oldLogo) {
                // Get name
                $oldLogo = substr($stringBody->response->oldLogo, -14);
                
                // Delete old logo
                Storage::disk('public')->delete('/companies/'.$oldLogo);
            }
            
            if (property_exists($stringBody->response, 'oldBackgroundImage') && $stringBody->response->oldBackgroundImage) {
                // Get name
                $oldBackgroundImage = substr($stringBody->response->oldBackgroundImage, -14);
                
                // Delete old background image
                Storage::disk('public')->delete('/companies/'.$oldBackgroundImage);
            }
            
            return redirect()->route('companies');
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
    }
    
    public function destroy($id) {
        try {
            $this->client->delete(env('API_BASE_URL').'admin/companies/'.$id);
            return redirect()->route('companies');
        } catch(RequestException $e) {
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
        
    }
}

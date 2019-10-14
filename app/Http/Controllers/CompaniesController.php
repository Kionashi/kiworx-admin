<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class CompaniesController extends Controller
{
    public function __construct()
    {
    
    }

    public function index(){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/companies', []);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        // dump($res->getStatusCode());
        // // "200"
        // dump($res->getHeader('content-type')[0]);
        // // 'application/json; charset=utf8'
        $companies = json_decode($res->getBody(),true);
        
        return view("pages.backend.companies.index")
            ->with('companies', $companies)
            ;

    }

    // public function index(){
    //     // if (!session()->exists('admin.id')) {
    //     //     session([
    //     //         'admin.id' => 1,
    //     //         'admin.name' => 'Víctor',
    //     //         'admin.lastname' => 'Cardozo'
    //     //     ]);
    //     // }
    //     $client = new Client();
    //     $res = $client->request('GET', env('API_BASE_URL').'admin/users');
    //     $adminUsers = json_decode($res->getBody(),true);

    //     return view("pages.backend.admin-users.index")
    //         ->with('adminUsers', $adminUsers)
    //         ;
    // }

    public function create(){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/users');
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $adminUsers = json_decode($res->getBody(),true);

        return view("pages.backend.companies.create")
            ->with('adminUsers',$adminUsers)
        ;
    }

    public function store(Request $request){
        $all = $request->all();
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $logo = $request->file('logo');
        $backgroundImage = $request->file('backgroundImage');
        $address = $request->address;
        $address_url = $request->address_url;
        $website = $request->website;
        $linkedin = $request->linkedin;
        $instagram = $request->instagram;
        $facebook = $request->facebook;
        $twitter = $request->twitter;
        $youtube = $request->youtube;
        $keyPersonName = $request->keyPersonName;
        $keyPersonImage = $request->file('keyPersonImage');
        $keyPersonTitle = $request->keyPersonTitle;
        $adminUserId = $request->adminUserId;

        $logoPath = $logo->getPathname();
        $logoMime = $logo->getmimeType();
        $logoName  = $logo->getClientOriginalName();

        $backgroundImagePath = $backgroundImage->getPathname();
        $backgroundImageMime = $backgroundImage->getmimeType();
        $backgroundImageName  = $backgroundImage->getClientOriginalName();

        $keyPersonImagePath = $keyPersonImage->getPathname();
        $keyPersonImageMime = $keyPersonImage->getmimeType();
        $keyPersonImageName  = $keyPersonImage->getClientOriginalName();

        // dd($request->hasFile('logo'));
        $client = new Client();
        // try{
        //     $response = $client->post(env('API_BASE_URL').'admin/companies/upload-file', [
        //                 'multipart' => [
        //                     [
        //                         'name'     => 'logo',
        //                         'filename' => $logoName,
        //                         'Mime-Type'=> $logoMime,
        //                         'contents' => fopen( $logoPath, 'r' ),
        //                     ],
        //                     ]
        //             ]);

        // } catch(ClientException $e){
        //     dd($e);
        // } catch(ServerException $e){
        //     dd($e->getCode());
        // }
        // dd($response->getCode());
        $body = [
            'all' => $all,
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'address' => $address,
            'address_url' => $address_url,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'youtube' => $youtube,
            'keyPersonName' => $keyPersonName,
            'keyPersonTitle' => $keyPersonTitle,
            'website' => $website,
            'adminUserId' => $adminUserId,
            
            ];
        try {
            $res = $client->post(env('API_BASE_URL').'admin/companies',[
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
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $response = json_decode($res->getBody()->getContents());
        return redirect()->route('companies');
    }

    public function details($id){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/companies/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $company = json_decode($res->getBody(),true);
        // dd($company);
        return view("pages.backend.companies.details")
            ->with('company', $company)
            ;
    }
    
    public function edit($id){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/companies/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $company = json_decode($res->getBody(),true);
        
        $res = $client->request('GET', env('API_BASE_URL').'admin/users');
        $adminUsers = json_decode($res->getBody(),true);

        return view("pages.backend.companies.edit")
            ->with('adminUsers', $adminUsers)
            ->with('company', $company)
            ;
    }

    public function update(Request $request){
        $id = $request->id;
        $all = $request->all();
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $logo = $request->file('logo');
        $backgroundImage = $request->file('backgroundImage');
        $address = $request->address;
        $address_url = $request->address_url;
        $website = $request->website;
        $linkedin = $request->linkedin;
        $instagram = $request->instagram;
        $facebook = $request->facebook;
        $twitter = $request->twitter;
        $youtube = $request->youtube;
        $keyPersonName = $request->keyPersonName;
        $keyPersonImage = $request->file('keyPersonImage');
        $keyPersonTitle = $request->keyPersonTitle;
        $adminUserId = $request->adminUserId;
        $body = [
            'all' => $all,
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'address' => $address,
            'address_url' => $address_url,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'youtube' => $youtube,
            'keyPersonName' => $keyPersonName,
            'keyPersonTitle' => $keyPersonTitle,
            'website' => $website,
            'adminUserId' => $adminUserId,
            
            ];
        $client = new Client();

            try{
                $res = $client->put(env('API_BASE_URL').'admin/companies/'.$id, ['body'=> json_encode($body)]);
            } catch(ClientException $e){
                dd($e);
            } catch(ServerException $e){
                dd($e->getCode());
            }
        $response = json_decode($res->getBody());
        return redirect()->route('companies');
    }

    public function destroy($id){
       
        $client = new Client();
        try{
            $res = $client->delete(env('API_BASE_URL').'admin/companies/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }

        return redirect()->route('companies');
    }
}

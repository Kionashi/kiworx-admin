<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class OffersController extends Controller
{
    public function __construct()
    {
    
    }

    public function index(){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/offers', []);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        // dump($res->getStatusCode());
        // // "200"
        // dump($res->getHeader('content-type')[0]);
        // // 'application/json; charset=utf8'
        $offers = json_decode($res->getBody(),true);
        // dd($offers);
        return view("pages.backend.offers.index")
            ->with('offers', $offers)
            ;

    }

    public function create(){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/companies');
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $companies = json_decode($res->getBody(),true);

        return view("pages.backend.offers.create")
            ->with('companies',$companies)
        ;
    }

    public function store(Request $request){
        $all = $request->all();
        $position = $request->position;
        $description = $request->description;
        $experience = $request->experience;
        $start_date = $request->start_date;
        $contract_type = $request->contract_type;
        $category = $request->category;
        $companyId = $request->companyId;

        $body = [
            'all' => $all,
            'position' => $position,
            'description' => $description,
            'experience' => $experience,
            'start_date' => $start_date,
            'contract_type' => $contract_type,
            'category' => $category,
            'companyId' => $companyId,
            ];
        $client = new Client();
        Try {
            $res = $client->post(env('API_BASE_URL').'admin/offers',[
                'body'=> json_encode($body)
            ]);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $response = json_decode($res->getBody()->getContents());
        // dd($response);
        return redirect()->route('offers');
    }

    public function details($id){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/offers/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $offer = json_decode($res->getBody(),true);
        // dd($offer);
        return view("pages.backend.offers.details")
            ->with('offer', $offer)
            ;
    }
    
    public function edit($id){
        $client = new Client();
        try{
            $res = $client->request('GET', env('API_BASE_URL').'admin/offers/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $offer = json_decode($res->getBody(),true);
        
        $res = $client->request('GET', env('API_BASE_URL').'admin/companies');
        $companies = json_decode($res->getBody(),true);
        // dd($offer);
        return view("pages.backend.offers.edit")
            ->with('companies', $companies)
            ->with('offer', $offer)
            ;
    }

    public function update(Request $request){
        $id = $request->id;
        $all = $request->all();
        $position = $request->position;
        $description = $request->description;
        $experience = $request->experience;
        $start_date = $request->start_date;
        $contract_type = $request->contract_type;
        $category = $request->category;
        $finished = $request->finished;
        $companyId = $request->companyId;
        // dd($finished);
        if($finished == 'true'){
            
            $finished = true;
        }else{
            $finished = false;
        }
        $body = [
            'all' => $all,
            'position' => $position,
            'description' => $description,
            'experience' => $experience,
            'start_date' => $start_date,
            'contract_type' => $contract_type,
            'category' => $category,
            'finished' => $finished,
            'companyId' => $companyId,
            ];
        $client = new Client();
            try{
                $res = $client->put(env('API_BASE_URL').'admin/offers/'.$id, ['body'=> json_encode($body)]);
            } catch(ClientException $e){
                dd($e);
            } catch(ServerException $e){
                dd($e->getCode());
            }
        $response = json_decode($res->getBody());
        return redirect()->route('offers');
    }

    public function destroy($id){
       
        $client = new Client();
        try{
            $res = $client->delete(env('API_BASE_URL').'admin/offers/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }

        return redirect()->route('offers');
    }
}

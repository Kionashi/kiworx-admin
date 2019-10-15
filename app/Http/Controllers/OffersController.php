<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;

class OffersController extends Controller
{

    public function index(){
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/offers', []);
            $offers = json_decode($res->getBody(),true);
            
            return view("pages.backend.offers.index")
                ->with('offers', $offers)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        
    }

    public function create(){
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/companies');
            $companies = json_decode($res->getBody(),true);
            
            return view("pages.backend.offers.create")
                ->with('companies',$companies)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }

    public function store(Request $request){
        try {
            
            $body = [
                'all' => $request->all(),
                'position' => $request->position,
                'description' => $request->description,
                'experience' => $request->experience,
                'start_date' => $request->start_date,
                'contract_type' => $request->contract_type,
                'category' => $request->category,
                'companyId' => $request->companyId,
            ];
            $this->client->post(env('API_BASE_URL').'admin/offers',[
                'body'=> json_encode($body)
            ]);
            return redirect()->route('offers');
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        
    }

    public function details($id){
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/offers/'.$id);
            $offer = json_decode($res->getBody(),true);
            // dd($offer);
            return view("pages.backend.offers.details")
                ->with('offer', $offer)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }
    
    public function edit($id){
        try{
            $res = $this->client->request('GET', env('API_BASE_URL').'admin/offers/'.$id);
            $offer = json_decode($res->getBody(),true);
            
            $res = $this->client->request('GET', env('API_BASE_URL').'admin/companies');
            $companies = json_decode($res->getBody(),true);
            // dd($offer);
            return view("pages.backend.offers.edit")
                ->with('companies', $companies)
                ->with('offer', $offer)
            ;
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
    }

    public function update(Request $request) {
        
        try{
            $finished = $request->finished == 'true'?true:false;
            
            $body = [
                'all' => $request->all(),
                'position' => $request->position,
                'description' => $request->description,
                'experience' => $request->experience,
                'start_date' => $request->start_date,
                'contract_type' => $request->contract_type,
                'category' => $request->category,
                'finished' => $finished,
                'companyId' => $request->companyId,
            ];
            $res = $this->client->put(env('API_BASE_URL').'admin/offers/'.$request->id, ['body'=> json_encode($body)]);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }
        $response = json_decode($res->getBody());
        return redirect()->route('offers');
    }

    public function destroy($id){
       
        try{
            $res = $this->client->delete(env('API_BASE_URL').'admin/offers/'.$id);
        } catch(ClientException $e){
            dd($e);
        } catch(ServerException $e){
            dd($e->getCode());
        }

        return redirect()->route('offers');
    }
}

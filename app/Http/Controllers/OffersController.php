<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;
use App\Enums\OfferApplicationStatus;

class OffersController extends Controller
{

    public function index(){
        try{
            // Get offers
            $res = $this->client->get(env('API_BASE_URL').'admin/offers/');
            $offers = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.offers.index")
                ->with('offers', $offers)
            ;
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
        
    }

    public function create(){
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/companies');
            $companies = json_decode($res->getBody(),true);
            
            return view("pages.backend.offers.create")
                ->with('companies',$companies)
            ;
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
    }

    public function store(Request $request){
        try {
            // Build request
            $body = $request->all();
            
            // Store offer
            $this->client->post(env('API_BASE_URL').'admin/offers',[
                'body'=> json_encode($body)
            ]);
            
            // Redirect to offers
            return redirect()->route('offers');
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
        
    }

    public function details($id, $phase){
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/offers/'.$id);
            $offer = json_decode($res->getBody(),true);
            $applicants = array();
            foreach ($offer['phases'] as $i => $offerPhase) {
                // Get applicants
                if ($i == $phase-1) $applicants = $offerPhase['applyments'];
                
                // Calculate rejected
                $rejected = 0;
                foreach ($offerPhase['applyments'] as $applyment) {
                    if ($applyment['status'] == OfferApplicationStatus::REJECTED) $rejected++;
                }
                $offer['phases'][$i]['rejected'] = $rejected;
                
            }
            
//             dd($offer, $applicants);
            return view("pages.backend.offers.details")
                ->with('offer', $offer)
                ->with('applicants', $applicants)
                ->with('currentPhase', $phase)
            ;
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
    }
    
    public function reject(Request $request){
        try {
            // Build request
            $body = $request->all();
            
            // Store offer
            $this->client->post(env('API_BASE_URL').'admin/offers/reject', [
                'body'=> json_encode($body)
            ]);
            
            // Redirect to offers
            return redirect()->route('offers/details', ['id' => $request->offerId, 'phase' => $request->phase]);
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
    }
    
    public function promote(Request $request){
        try {
            // Build request
            $body = $request->all();

            // Store offer
            $this->client->post(env('API_BASE_URL').'admin/offers/promote', [
                'body'=> json_encode($body)
            ]);
            
            // Redirect to offers
            return redirect()->route('offers/details', ['id' => $request->offerId, 'phase' => $request->phase]);
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
    }
    
    public function edit($id){
        try{
            $res = $this->client->request('GET', env('API_BASE_URL').'admin/offers/'.$id);
            $offer = json_decode($res->getBody(),true);
            $hashStr = '';
            foreach ($offer['hashtags'] as $i => $hashtag) {
                $hashStr = $i != 0 ? $hashStr.',': $hashtag['name'];
                $hashStr .= $hashtag['name'];
            }
            $offer['hashStr'] = $hashStr;
            $res = $this->client->request('GET', env('API_BASE_URL').'admin/companies');
            $companies = json_decode($res->getBody(),true);
            // dd($offer);
            return view("pages.backend.offers.edit")
                ->with('companies', $companies)
                ->with('offer', $offer)
            ;
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
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
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
        $response = json_decode($res->getBody());
        return redirect()->route('offers');
    }

    public function destroy($id){
       
        try{
            $this->client->delete(env('API_BASE_URL').'admin/offers/'.$id);
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
        
        return redirect()->route('offers');
    }
    
    public function publicList($company)
    {
        try {
            // Get admin user roles
            $res = $this->client->get(env('API_BASE_URL').'offers/'.$company);
            
            // Parse response
            $response = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.public.offers")
                ->with('offers', $response['offers'])
                ->with('company', $response['company'])
            ;
        } catch(RequestException $e) {
            return $this->handleError($e->getCode());
        }
    }
    
    public function publicDetail(Request $request, $company, $code)
    {
        try {
            // Get admin user roles
            $res = $this->client->get(env('API_BASE_URL').'offers/'.$code.'/jobs/'.$code);
            
            // Parse response
            $offer = json_decode($res->getBody(),true);
            
            // Store view
            $body = array(
                'clientIp' => $request->ip(),
                'clientUserAgent' => $request->server('HTTP_USER_AGENT'),
                'offerId' => $offer['id']
            );
            $res = $this->client->post(env('API_BASE_URL').'offer-views', ['body'=> json_encode($body)]);
            
            // Return view
            return view("pages.public.offer")
                ->with('offer',$offer)
                ->with('companyFriendlyName',$company)
                ->with('offerCode',$code)
            ;
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
    }
    
    public function storeApplyment(Request $request, $company, $code)
    {
        try {
            if ($request->hasFile('curriculum') && $request->curriculum->extension() == 'pdf') {
                // Store file
                $fileName = Str::random(10).'.'.$request->curriculum->extension();
                $request->curriculum->storeAs('public/curriculum', $fileName);
                
                // Build request body
                $body = [
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'company' => $company,
                    'offerCode' => $code,
                    'curriculum' => asset('storage/curriculum/'.$fileName)
                ];
                
                // Store applyment
                $res = $this->client->post(env('API_BASE_URL').'user', ['body'=> json_encode($body)]);
                $bod = $res->getBody();
                
                // Explicitly cast the body to a string
                $stringBody = json_decode($bod);
                
                if (property_exists($stringBody->response, 'oldCurriculum') && $stringBody->response->oldCurriculum) {
                    // Get name
                    $oldCurriculum = substr($stringBody->response->oldCurriculum, -14);
                    
                    // Delete old CV
                    Storage::disk('public')->delete('/curriculum/'.$oldCurriculum);
                    
                }
                
            } else {
                return redirect()->route('offer/public', ['company' => $company, 'code' => $code])->with('errorMessage', 'Wrong format, please upload your CV as PDF');
            }
            
            // Redirect to list
            return redirect()->route('offer/public', ['company' => $company, 'code' => $code])->with('disabledSubmit', true);
        } catch(RequestException $e) {
            // Handle error
            return $this->handleError($e->getCode());
        }
    }
    
}

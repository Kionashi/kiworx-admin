<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{

    public function index(){
        try{
            $res = $this->client->get(env('API_BASE_URL').'admin/offers', []);
            $offers = json_decode($res->getBody(),true);
            $offers = array(
                [
                    'id'        => 1,
                    'position'  => 'Programador Senior Android/Java',
                    'category'  => 'IT',
                    'company'   => array(
                        'name'  => 'Cabify España'
                    ),
                    'active'    => false
                ],
                [
                    'id'        => 2,
                    'position'  => 'Programador junio PHP',
                    'category'  => 'IT',
                    'company'   => array(
                        'name'  => 'Cabify España'
                    ),
                    'active'    => true
                ],
                [
                    'id'        => 1,
                    'position'  => 'Programador Senior Android/Java',
                    'category'  => 'IT',
                    'company'   => array(
                        'name'  => 'Cabify España'
                    ),
                    'active'    => false
                ],
                [
                    'id'        => 2,
                    'position'  => 'Programador junio PHP',
                    'category'  => 'IT',
                    'company'   => array(
                        'name'  => 'Cabify España'
                    ),
                    'active'    => true
                ]
            );
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
        } catch(RequestException $e){
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
        } catch(RequestException $e){
            dd($e->getCode());
        }
        
    }

    public function details($id){
        try{
//             $res = $this->client->get(env('API_BASE_URL').'admin/offers/'.$id);
//             $offer = json_decode($res->getBody(),true);
            $offer = array(
                'id'                => 1,
                'position'          => 'Programador Senior Android/Java',
                'category'          => 'IT',
                'phases'        => array(
                    [
                        'name'      => 'Aplicantes',
                        'applicant'  => '200',
                        'rejected'  => '0',
                        'isFinal'   => false
                    ],
                    [
                        'name'      => 'Elenius',
                        'applicant'  => '200',
                        'rejected'  => '190',
                        'isFinal'   => false
                    ],
                    [
                        'name'      => 'Entrevista #1',
                        'applicant'  => '10',
                        'rejected'  => '5',
                        'isFinal'   => false
                    ],
                    [
                        'name'      => 'Entrevista #2',
                        'applicant'  => '5',
                        'rejected'  => '1',
                        'isFinal'   => false
                    ],
                    [
                        'name'      => 'Propuesta',
                        'applicant'  => '4',
                        'rejected'  => '3',
                        'isFinal'   => false
                    ],
                    [
                        'name'      => 'Contratado',
                        'applicant'  => '1',
                        'rejected'  => '1',
                        'isFinal'   => true
                    ]
                    
                ),
                'active'            => false,
                'company'           => array(
'                   name'  => 'Cabify España'
                )
            );
            
            $applicants = array(
                [
                    'name'          => 'Víctor',
                    'lastname'      => 'Cardozo',
                    'email'         => 'vcardozo@kiworx.net',
                    'status'        => 'PENDING'
                ],
                [
                    'name'          => 'Santiago',
                    'lastname'      => 'Romero',
                    'email'         => 'romero@kiworx.net',
                    'status'        => 'ACCEPTED'
                ],
                [
                    'name'          => 'Javier',
                    'lastname'      => 'Cañizares',
                    'email'         => 'jcanizares@kiworx.net',
                    'status'        => 'REJECTED'
                ],
                [
                    'name'          => 'Víctor',
                    'lastname'      => 'Cardozo',
                    'email'         => 'vcardozo@kiworx.net',
                    'status'        => 'PENDING'
                ],
            );
            
            // dd($offer);
            return view("pages.backend.offers.details")
                ->with('offer', $offer)
                ->with('applicants', $applicants)
            ;
        } catch(RequestException $e){
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
        } catch(RequestException $e){
            dd($e->getCode());
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

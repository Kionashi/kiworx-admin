<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    
    public function publicDetail($company, $code)
    {
        try {
            // Get admin user roles
            $res = $this->client->get(env('API_BASE_URL').'offers/'.$code);
            
            // Parse response
            $offer = json_decode($res->getBody(),true);
//             dd($offer);
            // Return view
            return view("pages.public.offer")
                ->with('offer',$offer)
                ->with('companyFriendlyName',$company)
                ->with('offerCode',$code)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    public function storeApplyment(Request $request, $company, $code)
    {
        try{
            if ($request->hasFile('curriculum')) {
                $fileName = 'xxx.jpg';
                $request->curriculum->storeAs('public/curriculum', $fileName);
//                 dd(asset('storage/curriculum/'.$fileName));
                // Build request body
                $body = [
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'company' => $company,
                    'offerCode' => $code
                ];
                
//                 dd($this->curlGetContents(asset('storage/curriculum/'.$fileName)));
                
                // Store admin user
                $res = $this->client->request('POST',env('API_BASE_URL').'user',[
                    'multipart' => [
                        [
                            'name'     => 'curriculum',
                            'contents' => asset('storage/curriculum/'.$fileName),
                            'filename' => 'curriculum'
                        ],
                        [
                            'name'     => 'body',
                            'contents' => json_encode($body)
                        ]
                    ],
                    
                ]);
//                 $bod = $res->getBody();
//                 // Implicitly cast the body to a string and echo it
//                 echo $bod;
//                 // Explicitly cast the body to a string
//                 $stringBody = (string) $bod;
//                 // Read 10 bytes from the body
//                 $tenBytes = $bod->read(10);
//                 // Read the remaining contents of the body as a string
//                 $remainingBytes = $bod->getContents();
//                 dd('XXX', $bod, $stringBody, $tenBytes, $remainingBytes);
                
            } else {
                // Handle error
            }
            
            // Redirect to list
            return redirect()->route('offer/public', ['company' => $company, 'code' => $code])->with('disabledSubmit', true);
        } catch(ClientException $e){

            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    private function curlGetContents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Kiworx');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    
}

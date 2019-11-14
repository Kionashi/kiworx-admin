<?php

namespace App\Http\Controllers;
use App\User;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index() {
        // User management 
        try{
            // Get user list
            $res = $this->client->get(env('API_BASE_URL').'admin/users');
            
            // Parse response
            $users = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.users.index")
                ->with('users', $users)
            ;
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    public function requestUser() {
        $users = User::where('status', 'ENABLED')
        ->orderBy('updated_at', 'DESC')
        ->get()
        ;
        return response()->json([
            'users' => $users
        ]);
    }
    
    public function create() {
        return view('pages.backend.users.create');
    }
    
    public function store(Request $request) {
        try{
            // Build request body
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
                return redirect()->route('users')->with('errorMessage', 'Wrong format, please upload your CV as PDF');
            }
            
            // Redirect to list
            return redirect()->route('users');
            
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    public function edit($id){
        try {
            // Get user list
            $res = $this->client->get(env('API_BASE_URL').'admin/users/'.$id);
            
            // Parse response
            $user = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.users.edit")
                ->with('user', $user)
            ;
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    
    public function update(Request $request) {
        try{
            // Build request body
            $body = [
                'id'        => $request->id,
                'name'      => $request->name,
                'lastname'  => $request->lastname,
                'phone'     => $request->phone,
                'password'  => $request->password,
                'enabled'   => $request->enabled == 'on'?true:false,
                'deleted'   => $request->deleted == 'on'?true:false
            ];
            // Update admin user
            $this->client->put(env('API_BASE_URL').'admin/users/'.$request->id, ['body'=> json_encode($body)]);
            
            // Redirect to list
            return redirect()->route('users');
            
        } catch(RequestException $e){
            $exception = (string) $e->getResponse()->getBody();
            $exception = json_decode($exception);
            $jsonResponse = new JsonResponse($exception, $e->getCode());
            
            // Handle format error
            if($e->getCode() == 422) {
                return redirect()->route('users/edit', $request->id)->withErrors($jsonResponse->getData());
            }
            // Handle client unexpected error
            return $this->handleError($e->getCode());
        }
        
    }

    public function details($id) {
        try {
            // Get user
            $res = $this->client->get(env('API_BASE_URL').'admin/users/'.$id);
            $user = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.users.details")
                ->with('user', $user)
            ;
        } catch(RequestException $e) {
            // Handle client unexpected error
            return $this->handleError($e->getCode());
        }
        
    }

    public function destroy($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users');

    }
    
    public function candidatesDatabase() {
        // User management
        try{
            // Get user list
            $res = $this->client->get(env('API_BASE_URL').'admin/users');
            
            // Parse response
            $users = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.users.candidates")
                ->with('users', $users)
            ;
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
    public function candidatesDetails($id) {
        // User management
        try{
            // Get user list
            $res = $this->client->get(env('API_BASE_URL').'admin/users');
            
            // Parse response
            $users = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.users.candidates")
            ->with('users', $users)
            ;
        } catch(RequestException $e){
            return $this->handleError($e->getCode());
        }
    }
    
}

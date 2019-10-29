<?php

namespace App\Http\Controllers;
use App\User;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;

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
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
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
            $body = [
                'name'      => $request->name,
                'lastname'  => $request->lastname,
                'email'     => $request->email,
                'password'  => $request->password,
                'enabled'   => $request->enabled,
                'deleted'   => $request->deleted
            ];
            
            // Store user
            $this->client->post(env('API_BASE_URL').'admin/users',['body'=> json_encode($body)]);
            
            // Redirect to list
            return redirect()->route('users');
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
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
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
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
            dd($exception);
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
       $user = User::find($id);
        
        return view("pages.backend.users.details")
            ->with('user', $user)
        ;
    }

    public function destroy($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users');
        // return response()->json([
        //     'status' => 'Eliminado correctamente'
        // ]);

    }
}

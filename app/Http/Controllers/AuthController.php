<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }
    
    public function login()
    {
        return view('auth.login');
    }
    public function storeSession(Request $request)
    {
        try {
            // Initialize Guzzle client
            $client = new \GuzzleHttp\Client();
            $url = env('API_BASE_URL').'admin/login';
            
            // Build request
            $body = array();
            $body['email'] = $request->input('email');
            $body['password'] = $request->input('password');
            
            // Send http request
            $req = $client->post($url,  ['body' => json_encode($body)]);
            $response = json_decode($req->getBody());
            $isAdmin = false;
            foreach ($response->adminUser->role->permissions as $permission ) {
                if ($permission->code == 'super-admin') {
                    $isAdmin = true; break;
                }
            }
            // Store admin user data in session
            session([
                'admin.id' => $response->adminUser->id,
                'admin.name' => $response->adminUser->name,
                'admin.lastname' => $response->adminUser->lastname,
                'admin.permissions' => $response->adminUser->role->permissions,
                'admin.isSuperAdmin' => $isAdmin
            ]);
            
//             dd(session()->all());
            
            // Redirect to home
            return redirect()->route('home');
            
        } catch(ClientException $e) {
            // Error 4XX
            dd($e, $e->getCode());
        } catch(ServerException $e) {
            // Error 5XX
            dd($e, $e->getCode());
        }
        
    }
    
    public function logout()
    {
        // Delete session if exist
        if (session()->exists('admin.id')) session()->flush();
        
        // Redirect to login
        return redirect()->route('login');
    }
}

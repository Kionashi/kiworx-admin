<?php

namespace App\Http\Controllers;


use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
        // Delete session if exist
        if (session()->exists('admin.id')) session()->flush();
        
        return view('auth.login');
    }
    
    public function passwordRecovery()
    {
        return view('auth.passwords.email');
    }
    
    public function passwordEmail(Request $request)
    {
        try {
            // Initialize Guzzle client
            $url = env('API_BASE_URL').'password-recovery';
            
            $rules = array(
                'email' => 'required|email'
            );
            $this->validate($request, $rules);
            
            // Build request
            $body = array();
            $body['email'] = $request->input('email');
            
            // Send http request
            $req = $this->client->post($url,  ['body' => json_encode($body)]);
            
            // Redirect to home
            return redirect()->route('login')->with('successMsg', 'We have sent a link to your e-mail account so you can restore your password.');
            
        } catch(RequestException $e) {
//             dd($e->getResponse()->getBody()->getContents());
            if ($e->getCode() == 406) return redirect()->route('password-recovery')->withErrors(json_decode($e->getResponse()->getBody()->getContents())->error);
            
            // External errors
            return $this->handleError($e->getCode());
        }
        
    }
    
    public function storeSession(Request $request)
    {
        try {
            // Initialize Guzzle client
            $url = env('API_BASE_URL').'admin/login';
            
            // Build request
            $body = array();
            $body['email'] = $request->input('email');
            $body['password'] = $request->input('password');
            
            // Send http request
            $req = $this->client->post($url,  ['body' => json_encode($body)]);
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
                'admin.isSuperAdmin' => $isAdmin,
                'api-token' => $response->token
            ]);
            
            // Redirect to home
            return redirect()->route('home');
            
        } catch(RequestException $e) {
            // Login failed
//             dd(json_decode($e->getResponse()->getBody()->getContents())->error);
            if ($e->getCode() == 401) return redirect()->route('login')->withErrors(json_decode($e->getResponse()->getBody()->getContents())->error);
            
            // External errors
            return $this->handleError($e->getCode());
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

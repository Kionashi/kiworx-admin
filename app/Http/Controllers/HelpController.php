<?php

namespace App\Http\Controllers;


use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HelpController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            
            // Return view
            return view('pages.backend.help.contact');
            
        } catch (RequestException $e) {
            dd($e);
            $this->handleError($e->getCode());
        }
    }
    
    public function store(Request $request)
    {
//         dd($request->all());
        try{
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'phone' => 'required|max:255',
                'description' => 'required',
                'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
            
            $this->validate($request, $rules);
            
            // Build request body
            $body = [
                'name' => $request->name,
                'email' => $request->email,
                'description' => $request->description,
                'phone' => $request->phone,
                'clientIp' => $request->ip(),
                'clientUserAgent' => $request->server('HTTP_USER_AGENT'),
            ];
            
            if ($request->hasFile('attachment')) {
                // Store file
                $fileName = Str::random(10).'.'.$request->attachment->extension();
                $request->attachment->storeAs('public/help', $fileName);
                
                // Add path to request
                $body['attachment'] = asset('storage/help/'.$fileName);
            }
            
            // Store help
            $res = $this->client->post(env('API_BASE_URL').'admin/help/contact', ['body'=> json_encode($body)]);
            // Parse response
            $offer = json_decode($res->getBody(),true);
//             dd($offer);
            
            // Redirect to list
            return redirect()->route('help')->with('successMsg', 'Thank you for contacting us, we will contact you as soon as possible.');
            
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
    }
    
}

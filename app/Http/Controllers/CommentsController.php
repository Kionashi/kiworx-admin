<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request){
        try {
            // Build request
            $body = $request->all();
            // Store offer
            $res = $this->client->post(env('API_BASE_URL').'admin/comments',[
                'body'=> json_encode($body)
            ]);
//             $offers = json_decode($res->getBody(),true);
//             dd($offers);
            
            // Redirect to offers
            return redirect()->route('applicants/details', $request->applicantId);
        } catch(RequestException $e){
            dd($e);
            return $this->handleError($e->getCode());
        }
        
    }
}

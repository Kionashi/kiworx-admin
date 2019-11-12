<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $client;
    
    function __construct(){
        $this->client = new Client(['headers' => [
            'Content-Type'  => 'application/json',
            'Api-Token'     => session('api-token')
        ]]);
    }
    
    function handleError($code) {
        switch ($code) {
            case Response::HTTP_UNAUTHORIZED:
                return view("pages.error.401");
                break;
            case Response::HTTP_FORBIDDEN:
                return view("pages.error.403");
                break;
            case Response::HTTP_NOT_FOUND:
                return view("pages.error.404");
                break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return view("pages.error.500");
                break;
            default:
                return redirect()->route('login');
        }
    }
    
    public function relativeTime($time)
    {
        if(!is_numeric($time))
            $time = strtotime($time);
            
            $periods = array("second", "minute", "hour", "day", "week", "month", "year", "age");
            $lengths = array("60","60","24","7","4.35","12","100");
            
            $now = time();
            
            $difference = $now - $time;
            if ($difference <= 10 && $difference >= 0)
                return $tense = 'just now';
            elseif($difference > 0)
                $tense = 'ago';
            elseif($difference < 0)
                $tense = 'later';
            
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            $period =  $periods[$j] . ($difference >1 ? 's' :'');
            return "{$difference} {$period} {$tense} ";
    }
}

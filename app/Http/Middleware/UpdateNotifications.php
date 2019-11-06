<?php

namespace App\Http\Middleware;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

use Closure;

class UpdateNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $client = new Client(['headers' => ['Api-Token' => session('api-token')]]);
        // $dafuq = $client->get(env('API_BASE_URL').'admin/notifications/admin-user/'.session()->get('admin.id').'/demo');
        // dd($dafuq);
        try {
            $res = $client->get(env('API_BASE_URL').'admin/notifications/admin-user/'.session()->get('admin.id'));
            $notifications = json_decode($res->getBody(),true);
            // dd($notifications);
            $count = 0;
            foreach($notifications as $notification){
                if($notification['status'] == 'ACTIVE'){
                    $count++;
                }
            }
            session([ 'notifications' => $notifications ]);
            session([ 'activeNotificationsCount' => $count ]);

        } catch(ClientException $e){
            dd($e->getCode());
        } catch(ServerException $e){
            dd($e->getCode());
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(){
        try{
            // Get admin user list
            $res = $this->client->get(env('API_BASE_URL').'admin/notifications/admin-user/'.session('admin.id'));
            
            // Parse response
            $notifications = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.notifications.index")
                ->with('notifications', $notifications)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }
    public function details($id){
        try{
            //Deactivate notification
            $res = $this->client->put(env('API_BASE_URL').'admin/notifications/'.$id.'/deactivate');
            
            // Get notification
            $res = $this->client->get(env('API_BASE_URL').'admin/notifications/'.$id);
            
            // Parse response
            $notification = json_decode($res->getBody(),true);
            
            // Return view
            return view("pages.backend.notifications.details")
                ->with('notification', $notification)
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function delete($id){
        try{
            // Get admin user list
            $res = $this->client->delete(env('API_BASE_URL').'admin/notifications/'.$id);
            
            // Parse response
            $notification = json_decode($res->getBody(),true);
            
            // Return view
            return redirect()->route('notifications');
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }

    public function deactivate($id){
        try{
            // Get admin user list
            $res = $this->client->put(env('API_BASE_URL').'admin/notifications/'.$id);
            
            // Parse response
            $notification = json_decode($res->getBody(),true);
            
            // Return view
            return $notification
            ;
        } catch(ClientException $e){
            return $this->handleError($e->getCode());
        } catch(ServerException $e){
            return $this->handleError($e->getCode());
        }
    }
}

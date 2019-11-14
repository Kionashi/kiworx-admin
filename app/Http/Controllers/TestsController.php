<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\Campaing;
use Excel;
use App\Imports\VehiclesImport;
use App\Imports\CampaingsImport;
use Importer;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class TestsController extends Controller
{
    public function index(){
        // $user = new User();
        // $user->name = "admin";
        // $user->email = "admin@test.com";
        // $user->password = \bcrypt('test');
        // $user->save();

        // dump('exito','user: '.$user->email, 'password: '.test);

        return view('pages.test');
    }

    public function testPost(Request $request){
        dd('exito', $request->all());
    }


    //Transform the url that returns the move method so it can be used in img tags 
    public function fixUrl($path){
        $path = str_replace("\\", "/", $path);
        $path = "/".$path;
        return $path;
    }
}

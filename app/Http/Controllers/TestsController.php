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
    public function test(){
        // $user = new User();
        // $user->name = "admin";
        // $user->email = "admin@test.com";
        // $user->password = \bcrypt('test');
        // $user->save();

        // dump('exito','user: '.$user->email, 'password: '.test);

        return view('pages.test');
    }

    public function testPost(Request $request){
        // $this->validate($request, [
        //     'file' => 'required|mime:xls,xlsx'
        // ]);
        
        if ($request->hasFile('excel')) {
            $excel = $request->excel;
            $extension = $excel->getClientOriginalExtension();
            $fileName = "PERICO." . $extension;
            $destinationPath = 'uploads';
            $path = $excel->move($destinationPath, $fileName);
            // $path = $this->fixUrl($path);
        }else {
            return "NO FILE";
        }
        $currentCampaings = Campaing::with('vehicles')->get();
        $initialCampaingCount = $currentCampaings->count();
        $currentVehicles = Vehicle::all();
        $initialVehiclesCount = $currentVehicles->count();
        $reader = ReaderEntityFactory::createReaderFromFile($path->getPathName());
        $reader->open($path->getPathName());

        foreach ($reader->getSheetIterator() as $sheetKey => $sheet) {
            if($sheetKey > 1){

                foreach ($sheet->getRowIterator() as $key => $row) {
                    if($key > 1){
                        $cells = $row->getCells();
                        $campaingName = $cells[0]->getValue();
                        $vehicleSerial = $cells[1]->getValue();
                        //If the name of the campaing hasn't been added yet in the addedCampaings array
                            $campaing = $currentCampaings->where('code',$campaingName)->first();
                            if(!$campaing){
                                $campaing = new Campaing();
                                $campaing->name = $campaingName;
                                $campaing->code = $campaingName;
                                $campaing->save();
                            }
                            $currentCampaings->push($campaing);
                            
                            $vehicle = $currentVehicles->where('serial',$vehicleSerial)->first();
                            if(!$vehicle){
                                $vehicle = new Vehicle();
                                $vehicle->serial = $vehicleSerial;
                                $vehicle->save();
                                $vehicle->campaings()->attach($campaing->id);
                                // dump('saving: '.$vehicleSerial);
                            }
                            $currentVehicles->push($vehicle);
                    }
                }
            }
        }
        
        $reader->close();

        // dump($currentCampaings);

        // dd('exito');

        return[
            'newCampaingsCount' => $currentCampaings->count() - $initialCampaingCount,
            'newVehiclesCount' => $currentVehicles->count() - $initialVehiclesCount,

        ];
        
    

    }


    //Transform the url that returns the move method so it can be used in img tags 
    public function fixUrl($path){
        $path = str_replace("\\", "/", $path);
        $path = "/".$path;
        return $path;
    }
}

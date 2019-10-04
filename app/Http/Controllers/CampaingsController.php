<?php

namespace App\Http\Controllers;
use App\Campaing;
use App\Vehicle;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CampaingsController extends Controller
{
    public function rules(Request $request){
        $response = new Campaing();
        $response->validationRules = [
            'name' => 'required|max:255',
            'code' => 'required|max:255|unique:campaings,code',

        ];
        $response->validationRulesUpdate = [
            'code' => 'required|max:255',
            'name' => ['required',
                Rule::unique('campaings')->ignore($request->campaingId),
                ]
        ];

        return $response;
    }

    public function index() {

        $campaings = Campaing::all()
            ;
        return view("pages.backend.campaings.index")
            ->with('campaings', $campaings)
            ;
    }

    public function create() {
        $events = Event::where('status','ENABLED')->get();
        return view('pages.backend.campaings.create')
            ->with('events',$events)
            ;
    }

    public function store(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRules);
        $name = $request->name;
        $code = $request->code;
        $selectedEvents = $request->events;

        $campaing = new Campaing();
        $campaing->name = $name;
        $campaing->code = $code;

        $campaing->save();
            foreach($selectedEvents as $eventId){
                $campaing->events()->attach($eventId); 
            }

            // return response()->json([
            //     'status' => 'guardado correctamente'
            // ]);

        return redirect()->route('campaings');
    }

    public function importExcel(Request $request){
        if ($request->hasFile('excel')) {
            $excel = $request->excel;
            $extension = $excel->getClientOriginalExtension();
            $fileName = "migration-excel." . $extension;
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
        $newVehiclesCount = 0;
        $newCampaingsCount = 0;
        $reader = ReaderEntityFactory::createReaderFromFile($path->getPathName());
        $reader->open($path->getPathName());

        foreach ($reader->getSheetIterator() as $sheetKey => $sheet) {
            if($sheetKey <= 1){
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
                                $newCampaingsCount++;
                            }
                            $currentCampaings->push($campaing);
                            
                            $vehicle = $currentVehicles->where('serial',$vehicleSerial)->first();
                            if(!$vehicle){
                                $vehicle = new Vehicle();
                                $vehicle->serial = $vehicleSerial;
                                $vehicle->save();
                                $vehicle->campaings()->attach($campaing->id);
                                $newVehiclesCount++;
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
            'newCampaingsCount' => $newCampaingsCount,
            'newVehiclesCount' => $newVehiclesCount,

        ];
    }

    public function details($id) {
       $campaing = Campaing::where('id',$id)
            ->with('events')
            ->first()
            ;

        return view("pages.backend.campaings.details")
            ->with('campaing', $campaing)
            ;
    }
    public function edit($id){
       $campaing = Campaing::where('id',$id)
            ->with('events')
            ->first()
            ;
        $events = Event::where('status','ENABLED')->get();


        // return $campaing;
        return view("pages.backend.campaings.edit")
            ->with('campaing',$campaing)
            ->with('events',$events)
            ;
    }



    public function update(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRulesUpdate);
        $name = $request->name;
        $events = $request->events;
        $code = $request->code;
        $id = $request->campaingId;

        $campaing = Campaing::find($id);
        $campaing->name = $name;
        $campaing->code = $code;
        $campaing->save();
       
        $campaing->events()->sync($events);

        return redirect()->route('campaings');
    }


    public function delete($id){

        $campaing = Campaing::find($id);
        $campaing->delete();
        return redirect()->route('campaings');
        // return response()->json([
        //     'status' => 'Eliminado correctamente'
        // ]);

    }
    public function storeREST($name){

        switch ($name) {
            case 'ENABLED':
                return 'ACTIVO';
                break;
            
            default:
                return 'INACTIVO';
                break;
        }
    }
    public function getCampaingsFromVehicle($serial){
        $vehicle = Vehicle::where('serial',$serial)->with('campaings')->first();
        if(!$vehicle){
            
            return response(['message' =>'Invalid serial']);
        }
            return response(['message' => 'Success', 'data' => $vehicle->campaings]);
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
        $currentVehicles = Vehicle::all();
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

        return $currentCampaings->count();
        
    

    }

}

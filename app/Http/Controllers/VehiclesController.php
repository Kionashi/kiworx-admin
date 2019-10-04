<?php

namespace App\Http\Controllers;
use App\Campaing;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class VehiclesController extends Controller
{
    public function rules(Request $request){
        $response = new Vehicle();
        $response->validationRules = [
            'serial' => 'required|max:255|unique:vehicles,serial',

        ];
        $response->validationRulesUpdate = [
            'serial' => ['required','max:255',
                Rule::unique('vehicles')->ignore($request->vehicleId),
                ]
        ];

        return $response;
    }

    public function index() {

        $vehicles = Vehicle::all()
            ;
        return view("pages.backend.vehicles.index")
            ->with('vehicles', $vehicles)
            ;
    }

    public function create() {
        $campaings = Campaing::all();
        return view('pages.backend.vehicles.create')
            ->with('campaings',$campaings)
            ;
    }

    public function store(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRules);
        $serial = $request->serial;
        $selectedcampaings = $request->campaings;

        $vehicle = new Vehicle();
        $vehicle->serial = $serial;
        $vehicle->save();
        $vehicle->campaings()->sync($selectedcampaings);

            // return response()->json([
            //     'status' => 'guardado correctamente'
            // ]);

        return redirect()->route('vehicles');
    }

    public function details($id) {
       $vehicle = Vehicle::where('id',$id)
            ->with('campaings')
            ->first()
            ;

        return view("pages.backend.vehicles.details")
            ->with('vehicle', $vehicle)
            ;
    }
    public function edit($id){
       $vehicle = Vehicle::where('id',$id)
            ->with('campaings')
            ->first()
            ;
        $campaings = Campaing::all();

        return view("pages.backend.vehicles.edit")
            ->with('vehicle',$vehicle)
            ->with('campaings',$campaings)
            ;
    }



    public function update(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRulesUpdate);
        $serial = $request->serial;
        $campaings = $request->campaings;
        $id = $request->vehicleId;

        $vehicle = Vehicle::find($id);
        $vehicle->serial = $serial;
        $vehicle->save();
       
        $vehicle->campaings()->sync($campaings);

        return redirect()->route('vehicles');
    }


    public function delete($id){

        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect()->route('vehicles');
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
}

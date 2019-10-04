<?php

namespace App\Http\Controllers;
use App\Workshop;
use Illuminate\Http\Request;
use App\Http\Requests\workshopValidate;
use Illuminate\Validation\Rule;

class WorkshopsController extends Controller
{
    public function rules(Request $request){
        $response = new Workshop();
        $response->validationRules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:workshops,email',
            'address' => 'required|max:255',
        ];
        $response->validationRulesUpdate = [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => ['required','max:255',
                Rule::unique('workshops')->ignore($request->workshopId),
                ]
        ];

        return $response;
    }

    public function index() {

        $workshops = Workshop::all()
            ;
        return view("pages.backend.workshops.index")
            ->with('workshops', $workshops)
            ;
    }

    public function requestworkshop() {
        $workshops = Workshop::all()
        ;
        return response()->json([
            'workshops' => $workshops
        ]);
    }

    public function create() {
        return view('pages.backend.workshops.create');
    }

    public function store(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRules);
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;

        $workshop = new Workshop();
        $workshop->name = $name;
        $workshop->email = $email;
        $workshop->address = $address;

        $workshop->save();
        // return response()->json([
        //     'status' => 'guardado correctamente'
        // ]);

        return redirect()->route('workshops');
    }

    public function edit($id){
       $workshop = Workshop::find($id);

        // return $workshop;
        return view("pages.backend.workshops.edit")
            ->with('workshop',$workshop)
            ;
    }

    public function details($id) {
       $workshop = Workshop::find($id);

        return view("pages.backend.workshops.details")
            ->with('workshop', $workshop)
            ;
    }


    public function update(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRulesUpdate);
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $id = $request->workshopId;

        $workshop = Workshop::find($id);
        $workshop->name = $name;
        $workshop->email = $email;
        $workshop->address = $address;
        $workshop->save();

        return redirect()->route('workshops');
    }


    public function destroy($id){

        $workshop = Workshop::find($id);
        $workshop->delete();
        return redirect()->route('workshops');
        // return response()->json([
        //     'status' => 'Eliminado correctamente'
        // ]);

    }

    public function getWorkshops(){
        $workshops = Workshop::all();
        return response(['message' => 'Success',
                        'data' => $workshops            
            ]);
    }
}

<?php

namespace App\Http\Controllers;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{
    public function rules(Request $request){
        $response = new Event();
        $response->validationRules = [
            'name' => 'required|max:255',
            'code' => 'required|max:255|unique:events,code',
            'from' => 'required|max:255',
            'to' => 'required|max:255',

        ];
        $response->validationRulesUpdate = [
            'name' => 'required|max:255',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            'code' => ['required',
                Rule::unique('events')->ignore($request->eventId),
                ]
        ];

        return $response;
    }

    public function index() {

        $events = Event::all()
            ;
        foreach ($events as $event ) {
            $event->estado = $this->translateStatus($event->status);
        }
        return view("pages.backend.events.index")
            ->with('events', $events)
            ;
    }

    public function create() {
        return view('pages.backend.events.create');
    }

    public function store(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRules);
        $name = $request->name;
        $code = $request->code;
        $from = $request->from ;
        $to = $request->to;
        $status = 'ENABLED';

        $event = new Event();
        $event->name = $name;
        $event->code = $code;
        $event->from = $from;
        $event->to = $to;
        $event->status = $status;
        $event->save();
        // return response()->json([
        //     'status' => 'guardado correctamente'
        // ]);

        return redirect()->route('events');
    }

    public function details($id) {
       $event = Event::find($id);
       $event->estado = $this->translateStatus($event->status);

        return view("pages.backend.events.details")
            ->with('event', $event)
            ;
    }
    public function edit($id){
       $event = Event::find($id);

        // return $event;
        return view("pages.backend.events.edit")
            ->with('event',$event)
            ;
    }



    public function update(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRulesUpdate);
        $name = $request->name;
        $code = $request->code;
        $from = $request->from;
        $status = $request->status;
        $to = $request->to;
        $id = $request->eventId;

        $event = Event::find($id);
        $event->name = $name;
        $event->code = $code;
        $event->from = $from;
        $event->status = $status;
        $event->to = $to;
        $event->save();

        return redirect()->route('events');
    }


    public function delete($id){

        $event = Event::find($id);
        $event->delete();
        return redirect()->route('events');
        // return response()->json([
        //     'status' => 'Eliminado correctamente'
        // ]);

    }
    public function translateStatus($name){

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

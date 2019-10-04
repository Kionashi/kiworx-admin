<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserValidate;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function rules(Request $request){
        $response = new User();
        $response->validationRules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:15|min:6',
            'passwordConfirmation' => 'required|same:password',
        ];
        $response->validationRulesUpdate = [
            'name' => 'required|max:255',
            'email' => ['required',
                Rule::unique('users')->ignore($request->userId),
                ]
        ];

        return $response;
    }

    public function index() {

        $users = User::all()
            ;
        return view("pages.backend.users.index")
            ->with('users', $users)
            ;
    }

    public function requestUser() {
        $users = User::where('status', 'ENABLED')
        ->orderBy('updated_at', 'DESC')
        ->get()
        ;
        return response()->json([
            'users' => $users
        ]);
    }

    public function create() {
        return view('pages.backend.users.create');
    }

    public function store(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRules);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password ;
        $passwordConfirmation = $request->passwordConfirmation;

        $user = new User();
        $user->name = $name;
        $user->email = $email;

        $user->password = \bcrypt($password);
        $user->save();
        // return response()->json([
        //     'status' => 'guardado correctamente'
        // ]);

        return redirect()->route('users');
    }

    public function edit($id){
       $user = User::find($id);

        // return $user;
        return view("pages.backend.users.edit")
            ->with('user',$user)
            ;
    }

    public function details($id) {
       $user = User::find($id);

        return view("pages.backend.users.details")
            ->with('user', $user)
            ;
    }


    public function update(Request $request) {
        $rules = $this->rules($request);
        $validateData = $request->validate($rules->validationRulesUpdate);
        $name = $request->name;
        $email = $request->email;
        $id = $request->userId;

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->save();

        return redirect()->route('users');
    }


    public function destroy($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users');
        // return response()->json([
        //     'status' => 'Eliminado correctamente'
        // ]);

    }
}

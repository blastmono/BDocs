<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Institucion;
use App\Models\Organizacion;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
    }

    public function index(){
        $usuarios = User::all();
        $roles = Role::pluck('name')->all();
        return view('auth.index',compact('usuarios','roles'));
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $organizaciones = Organizacion::all();
        $instituciones = Institucion::all();

        $roles = Role::pluck('name')->all();
        return view('auth.register',compact('roles','organizaciones','instituciones'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'rut' => ['required','string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'roles'=>'required'
        ]);

        $user = User::create([
            'rut' => $request->rut,
            'grado'=>$request->grado,
            'nombres'=>$request->nombres,
            'apellidoPaterno' => $request->apellidoPaterno,
            'apellidoMaterno' => $request->apellidoMaterno,
            'institucion_id'=> $request->institucion_id,
            'organizacion_id'=>$request->organizacion_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        $user->assignRole($request->roles);

        event(new Registered($user));
        DB::select('call auditorias(?,?)',array(Auth::user()->rut,'Creacion de Usuario:'.$request->rut ));
        Auth::login($user);

       
        return redirect(RouteServiceProvider::HOME);
    }
}

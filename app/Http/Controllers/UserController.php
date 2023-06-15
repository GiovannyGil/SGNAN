<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;




class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');

    }


    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index',compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::where('status', 'ACTIVE')->pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

// EL store ES PARA GUARDAR EN NUESTRO FORMULARIO   
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->only('name','email', 'roles')
        + [
            'password' => bcrypt($request->input('password')),
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user->syncRoles($request->input('roles'));
        
        return redirect()->route('users.index')->with('Crear', 'Usuario registrado exitosamente');
    }

    // El show ES PARA VER A DETALLE LA INFORMACION DEL USUARIO
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    //El edit ES PARA MOSTRAR LA VISTA DEL EDITAR UN USUARIO
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
    
        return view('users.edit',compact('user','roles'));
    }

    //El update ES PARA ACTALIZAR LOS DATOS DEL USUARIO
    Public function update(UserEditRequest $request, $id)
    {
        $user=User::findOrFail($id);
        $data = $request->only('name', 'email', 'roles');

        if (trim($request->password)=='') 
        {
            $data = $request->except('password');
        }
        else{
            $data = $request->all();
            $data['password']=bcrypt($request->password); 
        }
        $user->update($data);
        
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index', $user)->with('Editar', 'Usuario actualizado exitosamente');
    } 

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('Eliminar', 'Usuario eliminado exitosamente');

    }

    public function change_status(User $user, Role $roles)
    {
        if ($user->status == 'ACTIVE') {
            $user->update(['status' => 'DEACTIVATED']);
            return redirect('/users')->with('Active', 'Se desactivar el usuario');
        } 
        else {
            $user->update(['status' => 'ACTIVE']);
            return redirect('/users')->with('inhabilitar', 'Se activara el usuario');
        } 
    }
}

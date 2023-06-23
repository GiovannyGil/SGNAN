<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
    }


    public function index(Request $request)
    {        
            $roles = Role::all();
            return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permission = Permission::all();
        return view('roles.create',compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
    
        $role = Role::create(['guard_name' => 'web', 'name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        // $role = Role::create($request->all());
        // $role->permissions()->sync($request->permissions);
        

        return redirect()->route('roles.index', $role)->with('Crear', 'El rol se creo con correctamente');                        
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        $role->name = $request->input('name');
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')->with('Editar', 'El rol se actualizo con éxito');                       
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')->with('Eliminar', 'El rol se eliminó con éxito');                            
    }

    public function change_status(Role $role)
    {
        if ($role->status == 'ACTIVE') {
            $role->update(['status' => 'DEACTIVATED']);
            return redirect('/roles')->with('Desactivar', 'Rol desactivado exitosamente');
        } 
        else {
            $role->update(['status' => 'ACTIVE']);
            return redirect('/roles')->with('activar', 'Rol activado exitosamente');
        } 
    }
}
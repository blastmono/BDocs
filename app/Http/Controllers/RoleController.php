<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role',['only'=>['index','show']]);
        $this->middleware('permission:create-role',['only' => ['create','store']]);
        $this->middleware('permission:edit-role',['only'=>['edit','update']]);
        $this->middleware('permission:delete-role',['only'=>['destroy']]);        
    }

    public function index(Request $request)
    {
        return view('roles.index', [
            'roles' => Role::orderBy('id','DESC')->paginate(10)
        ]);
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);
        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
        $role->syncPermissions($permissions);
        Log::info('['.Auth()->user()->Organizacion->sigla.'/'.Auth()->user()->rut. '] - Actualiza los permisos de usuario.');
        return redirect()->route('roles.index')->with('success','Roles Actualizado');
    }

    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions","permission_id","=","id")
            ->where("role_id",$role->id)
            ->select('name')
            ->get();
        
        return view('roles.show',compact('role','rolePermissions'));
    }

    public function edit(Role $role)
    {
        if($role->name=='Super Admin')
        {
            abort(403,'Super ADMIN NO PUEDE SER MODIFICADO');
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_id",$role->id)
            ->pluck('permission_id')
            ->all();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('roles.edit', ['role'=> $role,'permissions'=>Permission::get(),'rolePermissions'=>$rolePermissions]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $input = $request->only('name');
        $role->update($input);
        $permissions = Permission::whereIn('id',$request->permissions)->get(['name'])->toArray();

        $role->syncPermissions($permissions);

        return redirect()->back()->withSuccess('Role Update Successfully');
    }

    public function destroy(Role $role)
    {
        if($role->name=='Super Admin')
        {
            abort(403,'Super Admin No puede ser eliminado');
        }        
        if(auth()->user()->hasRole($role->name))
        {
            abort(403,'NO SE PUEDE BORRAR EL ROL ASIGNADO');
        }
        $role->delete();
        return redirect()->route('roles.index')->withSuccess('El Rol ha sido eliminado correctamente.');

    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){

        $permission = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permission'));

    } // End Method

    public function AddPermission(){

        return view('backend.pages.permission.add_permission');

    } // End Method


    public function PermissionStore(Request $request){

        $role = Permission::create([
            'name' =>$request->name,
            'group_name' =>$request->group_name,

        ]);

        $notification = array(
            'message' => 'Permission Added Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.permission')->with($notification);

    } // End Method

    public function EditPermission($id){

        $permission = Permission::findOrfail($id);
        return view ('backend.pages.permission.edit_permission',compact('permission'));
    } // End Method

    public function UpdatePermission(Request $request){

        $per_id = $request->id;

        Permission::findOrfail($per_id)->update([
            'name' =>$request->name,
            'group_name' =>$request->group_name,

        ]);

        $notification = array(
            'message' => 'Permission Update Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.permission')->with($notification);


    } // End Method

    public function DeletePermission($id){

        Permission::findOrfail($id)->delete();

        $notification = array(
            'message' => 'Permission Delete Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->back()->with($notification);

    } // End Method

    ///////////////////// Roles All Method /////////////////////////

    public function AllRoles(){

        $roles = Role::all();
        return view('backend.pages.roles.all_roles',compact('roles'));

    } // End Method

    public function AddRoles(){

        return view('backend.pages.roles.add_roles');

    } // End Method

    public function RolesStore(Request $request){

        $role = Role::create([
            'name' =>$request->name,

        ]);

        $notification = array(
            'message' => 'Role Added Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.roles')->with($notification);

    } // End Method

    public function EditRoles($id){

        $roles = Role::findOrfail($id);
        return view ('backend.pages.roles.edit_roles',compact('roles'));

    } // End Method

    public function UpdateRoles(Request $request){

        $role_id = $request->id;

        Role::findOrfail($role_id)->update([
            'name' =>$request->name,

        ]);

        $notification = array(
            'message' => 'Role Update Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.roles')->with($notification);


    } // End Method

    public function DeleteRoles($id){

        Role::findOrfail($id)->delete();

        $notification = array(
            'message' => 'Role Delete Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->back()->with($notification);

    } // End Method


    //////////// Add Roles Permission Method ////////////////


    public function AddRolesPermission(){

        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view ('backend.pages.roles.add_roles_permission',compact('roles','permission','permission_groups'));

    } // End Method

    public function StoreRolesPermission(Request $request){

        $data = array();
        $permission = $request->permission;

        foreach($permission as $key => $item ) { 
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.roles.permission')->with($notification);

    } // End Method

    public function AllRolesPermission(){

        $roles = Role::all();
        return view ('backend.pages.roles.all_roles_permission',compact('roles'));

    } // End Method

    public function AdminEditRoles($id){

        $role = Role::findOrfail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view ('backend.pages.roles.edit_roles_permission',compact('role','permissions','permission_groups'));

    } // End Method

    public function RolePermissionUpdate(Request $request,$id){

        $role = Role::findOrfail($id);
        $permissions = $request->permission;

        $permissions = $request->permission;

        if (!empty($permissions)) {
        $permissionModels = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissionModels);

        }

        $notification = array(
            'message' => 'Role Permission Update Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.roles.permission')->with($notification);

    } // End Method

    public function AdminDeleteRoles($id){

        $role = Role::findOrfail($id);
         if(!is_null($role));{
                $role->delete();
         }

         $notification = array(
            'message' => 'Role Permission Delete Successfully',
            'alert-type' => 'success'
        ); 

         return redirect()->back()->with($notification);

    } // End Method

}

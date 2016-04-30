<?php

namespace App\Http\Controllers\Api;

use App\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Http\Requests;

class PermissionController extends Controller
{
    public function GetUsers(){
        if(Gate::denies(Permission::$permissionRequire['GetUsers'])){
            return 'permission denied';
        }
        return json_encode(Permission::GetUsers());
    }

    public function GetPermissions(){
        if(Gate::denies(Permission::$permissionRequire['GetPermissions'])){
            return 'permission denied';
        }
        return json_encode(Permission::GetPermissions());
    }

    public function GetRoles(){
        if(Gate::denies(Permission::$permissionRequire['GetRoles'])){
            return 'permission denied';
        }
        return json_encode(Permission::GetRoles());
    }

    public function GetRolesByuser(){
        if(Gate::denies(Permission::$permissionRequire['GetRolesByuser'])){
            return 'permission denied';
        }
        return json_encode(Permission::GetRolesByuser());
    }

    public function GetRolesBypermission(){
        if(Gate::denies(Permission::$permissionRequire['GetRolesBypermission'])){
            return 'permission denied';
        }
        return json_encode(Permission::GetRolesBypermission());
    }

    public function EditUsers(Request $request){
        if(Gate::denies(Permission::$permissionRequire['EditUsers'])){
            return 'permission denied';
        }
        return json_encode(Permission::GetUsers());
    }

    public function EditPermissions(Request $request){
        switch ($request->input('type')) {
            case 'add':
                {
                    if(Gate::denies(Permission::$permissionRequire['AddPermissions'])){
                        return 'permission denied';
                    }
                    $details=json_decode($request->input('details'),true);
                    $newPermission = new Permission;
                    $newPermission->name = $details['name'];
                    $newPermission->label = $details['label'];
                    $newPermission->save();
                    return ['resultCode'=>'1'];
                }
                break;

            case 'delete':
                {
                    if(Gate::denies(Permission::$permissionRequire['DelPermissions'])){
                        return 'permission denied';
                    }
                    return json_encode(Permission::DelPermissions($request->input('id')));
                }
                break;

            case 'edit':
                {
                    if(Gate::denies(Permission::$permissionRequire['EditPermissions'])){
                        return 'permission denied';
                    }
                    $details=json_decode($request->input('details'),true);
                    return json_encode(Permission::EditPermissions(
                        $request->input('id'),
                        $details
                    ));
                }
                break;

            default:
                return 'bad request';
                break;
        }
    }

    public function EditRoles(Request $request){
        switch ($request->input('type')) {
            case 'add':
                {
                    if(Gate::denies(Permission::$permissionRequire['AddRoles'])){
                        return 'permission denied';
                    }
                    $details=json_decode($request->input('details'),true);
                    $role_admin = new Role;
                    $role_admin->name = $detail['name'];
                    $role_admin->label = $detail['label'];
                    $role_admin->save();
                    return ['resultCode'=>'1'];
                }
                break;
            case 'edit':
                {
                    if(Gate::denies(Permission::$permissionRequire['EditRoles'])){
                        return 'permission denied';
                    }
                    $details=json_decode($request->input('details'),true);
                    return json_encode(Permission::EditRoles(
                        $request->input('id'),
                        $details
                    ));
                }
                break;
            case 'delete':
                {
                    if(Gate::denies(Permission::$permissionRequire['DelRoles'])){
                        return 'permission denied';
                    }
                    return json_encode(Permission::DelRoles($request->input('id')));
                }
                break;
            default:
                return 'bad request';
                break;
        }
    }

    public function EditRolesByuser(Request $request){
        switch ($request->input('type')) {
            case 'add':
                {
                    if(Gate::denies(Permission::$permissionRequire['AddRolesByuser'])){
                        return 'permission denied';
                    }
                    return json_encode(Permission::AddRolesByuser($request->input('roleid'),$request->input('userid')));
                }
                break;
            case 'del':
                {
                    if(Gate::denies(Permission::$permissionRequire['DeleteRolesByuser'])){
                        return 'permission denied';
                    }
                    return json_encode(Permission::DeleteRolesByuser($request->input('roleid'),$request->input('userid')));
                }
                break;
            default:
                return 'bad request';
                break;
        }
    }

    public function EditRolesBypermission(Request $request){
        switch ($request->input('type')) {
            case 'add':
                {
                    if(Gate::denies(Permission::$permissionRequire['AddPermissionsByrole'])){
                        return 'permission denied';
                    }
                    return json_encode(Permission::AddPermissionsByrole($request->input('permissionid'),$request->input('roleid')));
                }
                break;
            case 'del':
                {
                    if(Gate::denies(Permission::$permissionRequire['DeletePermissionsByrole'])){
                        return 'permission denied';
                    }
                    return json_encode(Permission::DeletePermissionsByrole($request->input('permissionid'),$request->input('roleid')));
                }
                break;
            default:
                return 'bad request';
                break;
        }
    }
}

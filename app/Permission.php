<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // public static $permissionRequire=[
    //     'GetUsers'=>'PermissionEdit',
    //     'GetPermissions'=>'PermissionEdit',
    //     'GetRoles'=>'PermissionEdit',
    //     'GetRolesByuser'=>'PermissionEdit',
    //     'GetRolesBypermission'=>'PermissionEdit',
    //     'DelPermissions'=>'PermissionDel',
    //     'AddPermissions'=>'PermissionAdd',
    //     'EditPermissions'=>'PermissionEdit',
    //     'EditRoles'=>'RolesEdit',
    //     'DelRoles'=>'RolesDel',
    //     'AddRoles'=>'RolesAdd',
    //     'AddRolesByuser'=>'RoleUserAdd',
    //     'DeleteRolesByuser'=>'RoleUserDel',
    //     'AddPermissionsByrole'=>'PermissionRoleAdd',
    //     'DeletePermissionsByrole'=>'PermissionRoleDel'
    // ];

    public static $permissionRequire=[
        'GetUsers'=>'PermissionEdit',
        'GetPermissions'=>'PermissionEdit',
        'GetRoles'=>'PermissionEdit',
        'GetRolesByuser'=>'PermissionEdit',
        'GetRolesBypermission'=>'PermissionEdit',
        'DelPermissions'=>'PermissionDel',
        'AddPermissions'=>'PermissionAdd',
        'EditPermissions'=>'PermissionEdit',
        'EditRoles'=>'PermissionEdit',
        'DelRoles'=>'PermissionEdit',
        'AddRoles'=>'PermissionEdit',
        'AddRolesByuser'=>'PermissionEdit',
        'DeleteRolesByuser'=>'PermissionEdit',
        'AddPermissionsByrole'=>'PermissionEdit',
        'DeletePermissionsByrole'=>'PermissionEdit'
    ];

    public static function GetUsers(){
        $result=DB::table('users')
            ->leftJoin('role_user','users.id','=','role_user.user_id')
            ->select('users.id','name','email','role_id')
            ->get();
        return $result;
    }

    public static function GetPermissions(){
        $result=DB::table('permissions')
            ->get();
        return $result;
    }

    public static function GetRoles(){
        $result=DB::table('roles')
            ->get();
        return $result;
    }

    public static function GetRolesByuser(){
        $result=DB::table('role_user')
            ->join('users','users.id','=','role_user.user_id')
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('user_id','role_id','roles.name as role_name','users.name as user_name','email')
            ->get();
        return $result;
    }

    public static function GetRolesBypermission(){
        $result=DB::table('permission_role')
            ->get();
        return $result;
    }

    public static function DelPermissions($id){
        DB::table('permissions')
            ->where('id','=',$id)
            ->delete();
        return [
            'resultCode'=>'1'
        ];
    }

    public static function EditPermissions($id,$details){
        $updateQuery=DB::table('permissions')->where('id','=',$id);
        foreach ($details as $key => $value) {
            if($value===NULL){
                continue;
            }
            $updateQuery=$updateQuery->update([$key=>$value]);
        }
        return [
            'resultCode'=>'1',
            'details'=>$details
        ];
    }

    public static function EditRoles($id,$details){
        $updateQuery=DB::table('roles')->where('id','=',$id);
        foreach ($details as $key => $value) {
            if($value===NULL){
                continue;
            }
            $updateQuery=$updateQuery->update([$key=>$value]);
        }
        return [
            'resultCode'=>'1',
            'details'=>$details
        ];
    }

    public static function DelRoles($id){
        DB::table('roles')
            ->where('id','=',$id)
            ->delete();
        return [
            'resultCode'=>'1'
        ];
    }

    public static function AddRolesByuser($roleid,$userid){
        DB::table('role_user')
            ->insert([
                'role_id'=>$roleid,'user_id'=>$userid
            ]);
        return [
            'resultCode'=>'1'
        ];
    }

    public static function DeleteRolesByuser($roleid,$userid){
        DB::table('role_user')
            ->where('role_id','=',$roleid)
            ->where('user_id','=',$userid)
            ->delete();
        return [
            'resultCode'=>'1'
        ];
    }

    public static function AddPermissionsByrole($permissionid,$roleid){
        DB::table('permission_role')
            ->insert([
                'permission_id'=>$permissionid,'role_id'=>$roleid
            ]);
        return [
            'resultCode'=>'1'
        ];
    }

    public static function DeletePermissionsByrole($permissionid,$roleid){
        DB::table('role_user')
            ->where('role_id','=',$roleid)
            ->where('permission_id','=',$permissionid)
            ->delete();
        return [
            'resultCode'=>'1'
        ];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Profile extends Model
{
    public static $permissionRequire=[
      'Get'=>'PermissionEdit',
      'Edit'=>'PermissionEdit',
    ];

    public static function Get($stuid){
      $result=DB::table('profile')
        ->where('id','=',$stuid)
        ->get();
      return $result;
    }

    public static function Edit(){
      //todo
    }
    
    public static function Add($stuid,$stuname){
      DB::table('profile')
        ->insert([
          ['stuid'=>$stuid],
          ['stuname'=>$stuname]
        ]);
    }
}

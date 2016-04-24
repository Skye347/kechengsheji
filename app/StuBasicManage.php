<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class StuBasicManage extends Model
{
    protected $table='stubasic';

    public static $permissionRequire=[
        'GetList'=>'PermissionEdit',
        'Edit'=>'PermissionEdit',
    ];

    public static function GetList(){
        return Self::all();
    }

    public static function GetListWith($queryCond){
        $query=DB::table('stubasic');
        foreach ($queryCond as $key => $value) {
            if($value['type']==='and')
            $query=$query->where($value['target'],$value['op'],$value['opvalue']);
            else if($value['type']==='or')
            $query=$query->orWhere($value['target'],$value['op'],$value['opvalue']);
        }
        return $query->get();
    }

    public static function Edit($stuid,$stuname,$stugrade){
        $dataBefore=Self::where('stuId',$stuid)
            ->first();
        Self::where('stuId',$stuid)
            ->update([
                'stuName'=>$stuname,
                'stuGrade'=>$stugrade
            ]);
        $dataAfter=Self::where('stuId',$stuid)
            ->first();
        return [
            [
                'before'=>$dataBefore,
                'after'=>$dataAfter,
            ]
        ];
    }
}

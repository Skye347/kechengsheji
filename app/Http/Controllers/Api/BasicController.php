<?php

namespace App\Http\Controllers\Api;

use App\StuBasicManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Http\Requests;

class BasicController extends Controller
{
    public function GetList(){
        if(Gate::denies(StuBasicManage::$permissionRequire['GetList'])){
            return json_encode([
                'status'=>'1',
                'details'=>'1',
                'detailsString'=>'Permission denied'
            ]);
        }
        $result=StuBasicManage::GetList();
        return json_encode(
        [
            'status'=>'0',
            'count'=>count($result),
            'data'=>$result
        ]);
    }

    public function GetListWith(Request $request){
        if(Gate::denies(StuBasicManage::$permissionRequire['GetList'])){
            return json_encode([
                'status'=>'1',
                'details'=>'1',
                'detailsString'=>'Permission denied'
            ]);
        }
        $queryCond=json_decode($request->input('cond'),true);
        $result=StuBasicManage::GetListWith($queryCond);
        return json_encode(
        [
            'status'=>'0',
            'count'=>count($result),
            'data'=>$result,
            'query'=>$queryCond,
        ]);
    }

    public function Edit(Request $request){
        if(Gate::denies(StuBasicManage::$permissionRequire['Edit'])){
            return json_encode([
                'status'=>'1',
                'details'=>'1',
                'detailsString'=>'Permission denied'
            ]);
        }
        $result=StuBasicManage::Edit($request->input('stuid'),$request->input('stuname'),$request->input('stugrade'));
        return json_encode(
        [
            'status'=>'0',
            'count'=>count($result),
            'data'=>$result
        ]);
    }


}

//{"and":{"target":"stuid","op":"<","opvalue":"20"},"and":{"target":"stuid","op":">","opvalue":"5"}}

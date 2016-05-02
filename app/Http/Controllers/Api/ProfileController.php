<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;
use App\Profile;

class ProfileController extends Controller
{
    public function Get($stuid){
      if(Gate::denies(Profile::$permissionRequire['Get'])){
          return 'permission denied';
      }
      return json_encode(Profile::Get($stuid));
    }

    public function Edit(Request $request){
      if(Gate::denies(Profile::$permissionRequire['Edit'])){
          return 'permission denied';
      }
      //todo
      //return json_encode(Profile::Edit($userid));
    }
}

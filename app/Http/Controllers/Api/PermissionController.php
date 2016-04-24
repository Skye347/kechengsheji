<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Http\Requests;

class PermissionController extends Controller
{
    public function show(){
        if(Gate::denies('PermissionEdit')){
            return 'permission denied';
        }
        return json_encode(User::show());
    }
}

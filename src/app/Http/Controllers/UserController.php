<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function get(Request $request, int $id)
    {
        return $request->user();
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'phone' =>  'regex:/\+\d{12}/',
            'latitude' => array('numeric', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'),
            'longitude' => array('numeric', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'),
            'image' => 'base64|nullable',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $user = $request->user();

        if (isset($request->first_name)) {
            $user->first_name = $request->first_name;
        }
        if (isset($request->last_name)) {
            $user->last_name = $request->last_name;
        }
        $user->save();
        return $user;
    }
}

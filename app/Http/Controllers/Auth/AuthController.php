<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
//use Illuminate\Http\Response;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Transformers\UserAuthTransformer;
use App\UserDeviceAssoc;
use App\Device;



//use Symfony\Component\Debug\ErrorHandler;

/**
 * Description of AuthController
 *
 * @author chandrashekar
 */
class AuthController extends Controller {

    public function __construct() {
        $this->middleware("guest", ["except" => "getLogout"]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->only("email", "password");
        $userObject = new User();
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                $response = 'Your email and / or password are incorrect.';
                throw new \Dingo\Api\Exception\StoreResourceFailedException($response, $userObject->errors());
            }
        } catch (JWTException $ex) {
            return $this->response->error(["error", "Something went wrong."]);
        }


        $email = $request["email"];

        $user = User::where('email', $email)->with('role')->first();
      //return  $temp = User::where('id',$user['id'])->update(['remember_token'=> $token]);
      $user['remember_token']= $token;
        $user->save();
        // return $user;
        if ($user) {
          $record = UserDeviceAssoc::where('user_id', $user['id'])->latest()->first();

          if($record && $record['status'] == 'ENGAGE'){
            $user['device_id']= $record['device_id'];
            $user['device_name']= Device::where('id', $record['device_id'])->pluck('device_id')->first();
          }

          return response()->json(['status_code' => 200, 'message' => 'user login successfully', 'data' => $user]);
        } else {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Invalid email address entered.', $userObject->errors());
        }


    }

}

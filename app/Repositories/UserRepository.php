<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use  App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use stdClass;
class UserRepository implements UserRepositoryInterface
{
       public function getLoginInfo($data){
            
            $token = auth()->user()->createToken('API Token')->accessToken;
            $UserDetails=['userinfo'=>auth()->user(), 'message'=>'login Successful', 'token' => $token];
            return $UserDetails;
            

       }

       public function storeRegistrationInfo($data){
          $user=User::create([
               'name'=>$data['name'],
               'email'=>$data['email'],
               'password'=>Hash::make($data['password'])


           ]);
           return $user;
       }
}
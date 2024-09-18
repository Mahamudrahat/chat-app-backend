<?php

namespace App\Services\UserServices;

class UserResponseService{
    public function validationErrorResponse($errors){
        return Response([
            'success' => false, 
            'message' => 'পাঠানো ডাটা সঠিক নয় ',
            'data'=>$errors
        ], 400);
       }

       public function exceptionResponse($message)
       {
           return response()->json([
               'success' => false,
               'message' => $message
           ],500);
       }
       public function successResponseData($data){
           return response()->json([
               'success'=>true,
               'data'=>$data,
           ],200);
       }
       public function unauthorizedAccess(){
        return Response([
            'success' => false, 
            'message' => 'Unauthorized Access'
        ], 401);
    }   

}
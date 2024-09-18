<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\UserServices\UserResponseService;
use App\Services\UserServices\UserValidationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $UserRepository;
    protected $UserValidationService;
    protected $UserResponseService;

    public function __construct(UserRepositoryInterface $UserRepository,
    UserValidationService $UserValidationService,UserResponseService $UserResponseService)
    {
        $this->UserRepository = $UserRepository;
        $this->UserValidationService= $UserValidationService;
        $this->UserResponseService= $UserResponseService;
    }

    public function registerUser(Request $request)
     {

        try{
            $data=$request->all();
            $validateRules=$this->UserValidationService->getRegistrationValidation($data);
            $validateMessages = $this->UserValidationService->getRegistrationMessages();

            $validator = Validator::make($data,$validateRules,$validateMessages);
            if($validator->fails()){
                return $this->UserResponseService->validationErrorResponse($validator->errors());
            }
            $regusterUserInfo= $this->UserRepository->storeRegistrationInfo($data);
            return $this->UserResponseService->successResponseData($regusterUserInfo);

        }catch (\Exception $e) {
            return $this->UserResponseService->exceptionResponse($e->getMessage());
        }
}

     public function loginUser(Request $request)
     {
        try{$data=$request->all();
            $validateRules=$this->UserValidationService->getLoginInfoValidation($data);
            $validator = Validator::make($data,$validateRules);
            if($validator->fails()) {
                return $this->UserResponseService->validationErrorResponse($validator->errors());
            }
            if(auth()->attempt($data)){
               $userInfoData= $this->UserRepository->getLoginInfo($data);
               return $this->UserResponseService->successResponseData($userInfoData);
            }
            return $this->UserResponseService->unauthorizedAccess();
            
    
        
    }catch (\Exception $e) {
        return $this->UserResponseService->exceptionResponse($e->getMessage());
    }
     }

    public function index()
    {
        $users=User::all();
        return response()->json(["error"=>"false","data"=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

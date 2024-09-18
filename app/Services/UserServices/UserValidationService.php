<?php

namespace App\Services\UserServices;

class UserValidationService{
    
    public function getLoginInfoValidation($data){
        $rules=[
            'email' => ['required','regex:/^[\w\.\-]+@[a-zA-Z\d\-]+(\.[a-zA-Z\d\-]+)*\.[a-zA-Z]{2,7}$/','email:rfc,dns'],
            'password' => ['required']
        ];

        
        return $rules;
    }
    public function getRegistrationValidation($data){
        $rules=[
           'email' => [
                'required',
                'regex:/^[\w\.\-]+@[a-zA-Z\d\-]+(\.[a-zA-Z\d\-]+)*\.[a-zA-Z]{2,7}$/', // Custom regex pattern
                'email:rfc,dns', // RFC email format validation
                'unique:users,email', // Ensure unique email in users table
            ],
            'password' => ['required', 
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ],
            'name' => ['required', 'string'],
        ];
        return $rules;
    }
    public function getRegistrationMessages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.regex' => 'The email format is invalid.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'name.required' => 'The name field is required.',
        ];
    }

}
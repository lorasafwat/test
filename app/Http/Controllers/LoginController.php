<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Str;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginRec(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }
        $user = Receptionist::where("email", "=", $request->email)->first();

        if ($user != null) {
            $passwordCheck =   Hash::check($request->password, $user->password);
            if ($passwordCheck) {
                try {
                    $customClaims = ['fname' => $user->fname,'lname' => $user->lname,
                     'email' => $user->email];
                    $token = JWTAuth::claims($customClaims)->fromUser($user);
                    $user->update([
                        "token" => $token

                    ]);

                    return response()->json([
                        "msg" => "Welcome back!",
                        "token" => $token
                    ], 200);
                } catch (JWTException $e) {
                    return response()->json([
                        'error' => "Failed to create token". $e->getMessage()
                    ], 500);
                }
            }
        }
        return response()->json([
            'error' => "Invalid login credentials"
        ], 401);
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function loginPatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'MRN' => 'required|numeric|min:8',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 400);
        }

        $user = Patient::where("MRN", "=", $request->MRN)->first();

        if ($user != null) {
            $passwordCheck =   Hash::check($request->password, $user->password);
            if ($user != null) {
                $passwordCheck =   Hash::check($request->password, $user->password);
                if ($passwordCheck) {
                    try {
                        $customClaims = ['MRN' => $user->MRN,
                        'fname' => $user->fname,'lname' => $user->lname,
                        'protocol'=>$user->protocol,'age'=>$user->age,
                         ];
                        $token = JWTAuth::claims($customClaims)->fromUser($user);
                        $user->update([
                            "token" => $token
    
                        ]);
    
                        return response()->json([
                            "msg" => "Welcome back!",
                            "token" => $token
                        ], 200);
                    } catch (JWTException $e) {
                        return response()->json([
                            'error' => "Failed to create token". $e->getMessage()
                        ], 500);
                    }
                }
            }
            return response()->json([
                'error' => "Invalid login credentials"
            ], 401);
        }
    }
    ////////////////////////////////////////////////////////////////
    public function loginDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }
        $user = Doctor::where("email", "=", $request->email)->first();

        if ($user != null) {
            $passwordCheck =   Hash::check($request->password, $user->password);
            if ($passwordCheck) {
                try {
                    $customClaims = ['fname' => $user->fname,'lname' => $user->lname,
                     'email' => $user->email];
                    $token = JWTAuth::claims($customClaims)->fromUser($user);
                    $user->update([
                        "token" => $token

                    ]);

                    return response()->json([
                        "msg" => "Welcome back!",
                        "token" => $token
                    ], 200);
                } catch (JWTException $e) {
                    return response()->json([
                        'error' => "Failed to create token". $e->getMessage()
                    ], 500);
                }
            }
        }
        return response()->json([
            'error' => "Invalid login credentials"
        ], 401);
    }



}

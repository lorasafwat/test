<?php

namespace App\Http\Controllers;

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
                $token = Str::random(64);
                $user->update([
                    "token" => $token
                ]);

                return response()->json([
                    "msg" => "welcome back",
                    "token" => $token
                ], 200);
            }
        } else {
            return response()->json([
                'error' => "credintals not correct"
            ], 404);
        }
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
                'error' => $validator->errors()
            ], 400);
        }

        $user = Patient::where("MRN", "=", $request->MRN)->first();

        if ($user != null) {
            $passwordCheck =   Hash::check($request->password, $user->password);
            if ($passwordCheck) {
                $token = Str::random(64);
                $user->update([
                    "token" => $token
                ]);

                return response()->json([
                    "msg" => "welcome back",
                    "token" => $token
                ], 200);
            }
        } else {
            return response()->json([
                'error' => "credintals not correct"
            ], 404);
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
                $token = Str::random(64);
                $user->update([
                    "token" => $token
                ]);

                return response()->json([
                    "msg" => "welcome back",
                    "token" => $token
                ], 200);
            }
        } else {
            return response()->json([
                'error' => "credintals not correct"
            ], 404);
        }
    }



}

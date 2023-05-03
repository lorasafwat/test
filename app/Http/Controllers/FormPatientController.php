<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\PatientReasource;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FormPatientController extends Controller
{
    public function register(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
            'MRN' => 'required|numeric|min:8',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'age' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create new user
        // $token = JWTAuth::attempt([
        //     'MRN' => $request->input('MRN'),
        //     'fname' => $request->input('fname'),
        //     'lname' => $request->input('lname'),
        //     'protocol' => $request->input('protocol'),
        //     'age' => $request->input('age'),

        // ]);
        $patient = Patient::create([
            'MRN' => $request->input('MRN'),
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'password' => bcrypt($request->input('password')),
            'protocol' => $request->input('protocol'),
            'medical_history' => $request->input('medical_history'),
            'age' => $request->input('age'),
            'receptionist_id' => 1,
            // 'token' => $token
        ]);
        return response()->json([
            "msg" => "patient added successfully",
            //'token' => $token,
            "patient" => new PatientReasource($patient)
        ], 201);
    }
    ///////////////////////////////update////////////////////
    public function updatePatient(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'MRN' => 'required|numeric|min:8',
            "fname" => "required|string",
            "lname" => "required|string",
            "password" => "required|string|min:6",
            'age' => 'required|numeric',
        ]);
        if ($validator->fails()) {

            return response()->json([
                "msg" => $validator->errors()

            ], 409);
        }
        $patient = Patient::find($id);

        if ($patient == null) {
            return response()->json([
                "msg" => "patient not found"
            ], 404);
        }

        $password = bcrypt($request->password);
        //  $token = Str::random(64);
        $patient->update([
            "MRN" => $request->MRN,
            "fname" => $request->fname,
            "lname" => $request->lname,
            "password" => $password,
            "protocol" => $request->protocol,
            "age" => $request->age,
            "medical_history" => $request->medical_history,
            "receptionist_id" => "1",
            // "token" => $token

        ]);

        return response()->json([
            "msg" => "patient updated successfuly",
        ], 201);
    }

    ///////////////////////delete///////////////////
    public function deletePatient($id)
    {
        $patient = Patient::find($id);
        if ($patient == null) {
            return response()->json([
                "msg" => "patient not found"
            ], 404);
        }

        $patient->delete();

        return response()->json([
            "msg" => "patient deleted successfully",
            
        ], 200);
    }

    //////////////////////get data//////////////////
    public function getPatient()
    {
        Patient::all();
        return PatientReasource::collection(Patient::all());
    }
    
}
